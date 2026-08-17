class BookInStock
  def initialize(isbn, price)
    @isbn = isbn
    @price = Float(price)
  end
 
  def isbn
    @isbn
  end
 
  def price
    @price
  end
end
 
book = BookInStock.new("isbn1", 12.34)
puts "ISBN = #{book.isbn}"
puts "Price = #{book.price}"
 
class BookInStock
  attr_reader :isbn, :price
 
  def initialize(isbn, price)
    @isbn = isbn
    @price = Float(price)
  end
end
 
book = BookInStock.new("isbn1", 12.34)
puts "ISBN = #{book.isbn}"
puts "Price = #{book.price}"
 
class BookInStock
  attr_reader :isbn, :price
 
  def initialize(isbn, price)
    @isbn = isbn
    @price = Float(price)
  end
 
  def price=(new_price)
    @price = new_price
  end
end
 
book = BookInStock.new("isbn1", 33.80)
puts "ISBN = #{book.isbn}"
puts "Price = #{book.price}"
book.price = book.price * 0.75 # discount price
puts "New price = #{book.price}"
 
class BookInStock
  attr_reader :isbn
  attr_accessor :price
 
  def initialize(isbn, price)
    @isbn = isbn
    @price = Float(price)
  end
end
 
book = BookInStock.new("isbn1", 33.80)
puts "ISBN = #{book.isbn}"
puts "Price = #{book.price}"
book.price = book.price * 0.75 # discount price
puts "New price = #{book.price}"
 
class BookInStock
  attr_reader :isbn
  attr_accessor :price
 
  def initialize(isbn, price)
    @isbn = isbn
    @price = Float(price)
  end
 
  def price_in_cents
    Integer(price*100 + 0.5)
  end
end
 
book = BookInStock.new("isbn1", 33.80)
puts "Price = #{book.price}"
puts "Price in cents = #{book.price_in_cents}"
 
class BookInStock
  attr_reader :isbn
  attr_accessor :price
 
  def initialize(isbn, price)
    @isbn = isbn
    @price = Float(price)
  end
 
  def price_in_cents
    Integer(price*100 + 0.5)
  end
 
  def price_in_cents=(cents)
    @price = cents / 100.0
  end
end
 
book = BookInStock.new("isbn1", 33.80)
puts "Price = #{book.price}"
puts "Price in cents = #{book.price_in_cents}"
book.price_in_cents = 1234
puts "Price = #{book.price}"
puts "Price in cents = #{book.price_in_cents}"