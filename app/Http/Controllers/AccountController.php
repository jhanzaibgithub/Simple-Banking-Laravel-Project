<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function index()
    {
        $users = User::find(Auth::id()); // Get the current authenticated user
        $account = Account::where('user_id', Auth::id())->first();
        return view('account.home', compact('users', 'account'));

    }
    public function showDepositForm()
    {
        return view('account.deposit'); // Create this view
    }
    public function deposit(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1.0',
        ]);

        $account = Account::firstOrCreate(
            ['user_id' => Auth::id()],
            ['balance' => 0]
        );
        $beforeBalance = $account->balance;
        $account->balance += $request->amount;
        $account->save();
        Transaction::create([
            'account_id' => $account->id,
            'type' => 'deposit',
            'amount' => $request->amount,
            'before_balance' => $beforeBalance,
            'after_balance' => $account->balance,
        ]);
        return redirect('/home')->with('success', 'Deposit successful!');
    }

    public function showWithdrawForm()
    {
        return view('account.withdraw');
    }

    public function withdraw(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0.01'
        ]);

        $account = Account::where('user_id', Auth::id())->first();

        if ($account->balance < $request->amount) {
            return back()->withErrors(['amount' => 'Insufficient funds']);
        }

        $account->balance -= $request->amount;
        $account->save();

        Transaction::create([
            'account_id' => $account->id,
            'type' => 'withdrawal',
            'amount' => $request->amount,
            'before_balance' => $account->balance + $request->amount,
            'after_balance' => $account->balance,
        ]);

        return redirect('/home')->with('success', 'Withdrawal successful!');
    }
    public function showTransferForm()
    {
        return view('account.transfer');
    }
    public function transfer(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0.01',
            'email' => 'required|email'
        ]);
        $account = Account::where('user_id', Auth::id())->first();

        $receiver = User::where('email', $request->email)->first();

        if (!$receiver) {
            return back()->withErrors(['email' => 'Receiver not found']);
        }

        if ($account->balance < $request->amount) {
            return back()->withErrors(['amount' => 'Insufficient funds']);
        }

        $receiverAccount = Account::firstOrCreate(
            ['user_id' => $receiver->id],
            ['balance' => 0]
        );

        $account->balance -= $request->amount;
        $account->save();

        $receiverAccount->balance += $request->amount;
        $receiverAccount->save();

        Transaction::create([
            'account_id' => $account->id,
            'type' => 'transfer',
            'amount' => $request->amount,
            'before_balance' => $account->balance + $request->amount,
            'after_balance' => $account->balance,
            'receiver_email' => $request->email,
            'sender_id' => Auth::id(),
        ]);

        return redirect('/home')->with('success', 'Transfer successful!');
    }



    public function statement()
    {
        $account = Account::where('user_id', Auth::id())->first();
        $transactions = Transaction::where('account_id', $account->id)->get();
        return view('account.statement', compact('transactions'));
    }
}
