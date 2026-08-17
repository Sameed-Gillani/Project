class Person
  include Comparable
  attr_reader :name
 
  def initialize(name)
    @name = name
  end
 
  def to_s
    name
  end
 
  def <=>(other)
    name <=> other.name
  end
end
 
p1 = Person.new("Matz")
p2 = Person.new("Guido")
puts p1 > p2
puts [p1, p2].sort.map(&:to_s).inspect