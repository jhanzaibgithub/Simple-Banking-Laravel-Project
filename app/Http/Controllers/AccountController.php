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
        $users = User::find(Auth::id());
        $account = Account::where('user_id', Auth::id())->first();
        return view('account.home', compact('users', 'account'));

    }
    public function showDepositForm()
    {
        return view('account.deposit');
    }
    public function deposit(Request $request)
    {
        $this->validate($request, [
            'amount' => 'required|numeric|min:1.0',
        ]);
        $account = Account::firstOrCreate(
            ['user_id' => Auth::id()],
            ['balance' => 0]
        );
        $beforeBalance = $account->balance;
        $account->balance += $request->amount;
        $account->save();

        $transaction = new Transaction();
        $transaction->account_id = $account->id;
        $transaction->type = 'deposit';
        $transaction->amount = $request->amount;
        $transaction->before_balance = $beforeBalance;
        $transaction->after_balance = $account->balance;
        $transaction->save();

        return redirect('/home')->with('success', 'Deposit successful!');
    }


    public function showWithdrawForm()
    {
        return view('account.withdraw');
    }

    public function withdraw(Request $request)
    {
        $this->validate($request, [
            'amount' => 'required|numeric|min:1.0',
        ]);
        $account = Account::where('user_id', Auth::id())->first();

        if ($account->balance < $request->amount) {
            return back()->withErrors(['amount' => 'Insufficient funds']);
        }
        $beforeBalance = $account->balance;
        $account->balance -= $request->amount;
        $account->save();

        $transaction = new Transaction();
        $transaction->account_id = $account->id;
        $transaction->type = 'withdrawal';
        $transaction->amount = $request->amount;
        $transaction->before_balance = $beforeBalance;
        $transaction->after_balance = $account->balance;
        $transaction->save();

        return redirect('/home')->with('success', 'Withdrawal successful!');
    }

    public function showTransferForm()
    {
        return view('account.transfer');
    }
    public function transfer(Request $request)
    {
        $this->validate($request, [
            'amount' => 'required|numeric|min:1.0',
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

        $beforeBalance = $account->balance;

        $account->balance -= $request->amount;
        $account->save();

        $receiverAccount->balance += $request->amount;
        $receiverAccount->save();

        $transaction = new Transaction();
        $transaction->account_id = $account->id;
        $transaction->type = 'transfer';
        $transaction->amount = $request->amount;
        $transaction->before_balance = $beforeBalance;
        $transaction->after_balance = $account->balance;
        $transaction->receiver_email = $request->email;
        $transaction->sender_id = Auth::id();
        $transaction->save();
        return redirect('/home')->with('success', 'Transfer successful!');
    }

    public function statement()
    {
        $account = Account::where('user_id', Auth::id())->first();

        $transactions = Transaction::where('account_id', $account->id)->orWhere('receiver_email', Auth::user()->email)
        ->with('sender')->get();
        return view('account.statement', compact('transactions'));
    }


}
