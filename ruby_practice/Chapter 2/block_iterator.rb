{ puts "Hello" }
 
do
  club.enroll(person)
  person.socialize
end
 
greet { puts "Hi" }
 
verbose_greet("Dave", "loyal customer") { puts "Hi" }
 
def call_block
  puts "Start of method"
  yield
  yield
  puts "End of method"
end
 
call_block { puts "In the block" }
 
def who_says_what
  yield("Dave", "hello")
  yield("Andy", "goodbye")
end
 
who_says_what {|person, phrase| puts "#{person} says #{phrase}"}
 
animals = %w( ant bee cat dog ) # create an array
animals.each {|animal| puts animal } # iterate over the contents
 
[ 'cat', 'dog', 'horse' ].each {|name| print name, " " }
5.times { print "*" }
3.upto(6) {|i| print i }
('a'..'e').each {|char| print char }
puts