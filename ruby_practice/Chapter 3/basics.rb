class BookInStock
end
 
a_book = BookInStock.new
another_book = BookInStock.new
 
class BookInStock
  def initialize(isbn, price)
    @isbn = isbn
    @price = Float(price)
  end
end
 
class BookInStock
  def initialize(isbn, price)
    @isbn = isbn
    @price = Float(price)
  end
end
 
b1 = BookInStock.new("isbn1", 3)
p b1
b2 = BookInStock.new("isbn2", 3.14)
p b2
b3 = BookInStock.new("isbn3", "5.67")
p b3
 
class BookInStock
  def initialize(isbn, price)
    @isbn = isbn
    @price = Float(price)
  end
 
  def to_s
    "ISBN: #{@isbn}, price: #{@price}"
  end
end
 
b1 = BookInStock.new("isbn1", 3)
puts b1
b2 = BookInStock.new("isbn2", 3.14)
puts b2
b3 = BookInStock.new("isbn3", "5.67")
puts b3