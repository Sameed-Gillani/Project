class MyClass
  def method1 # default is 'public'
    #...
  end
 
  protected # subsequent methods will be 'protected'
 
  def method2 # will be 'protected'
    #...
  end
 
  private # subsequent methods will be 'private'
 
  def method3 # will be 'private'
    #...
  end
 
  public # subsequent methods will be 'public'
 
  def method4 # so this will be 'public'
    #...
  end
end
 
class MyClass
  def method1
  end
 
  def method2
  end
 
  # ... and so on
 
  public :method1, :method4
  protected :method2
  private :method3
end
 
class Account
  attr_accessor :balance
 
  def initialize(balance)
    @balance = balance
  end
end
 
class Transaction
  def initialize(account_a, account_b)
    @account_a = account_a
    @account_b = account_b
  end
 
  private
 
  def debit(account, amount)
    account.balance -= amount
  end
 
  def credit(account, amount)
    account.balance += amount
  end
 
  public
 
  #...
  def transfer(amount)
    debit(@account_a, amount)
    credit(@account_b, amount)
  end
  #...
end
 
savings = Account.new(100)
checking = Account.new(200)
trans = Transaction.new(checking, savings)
trans.transfer(50)
 
class Account
  attr_reader :cleared_balance # accessor method 'cleared_balance'
  protected :cleared_balance # but make it protected
 
  def greater_balance_than?(other)
    @cleared_balance > other.cleared_balance
  end
end