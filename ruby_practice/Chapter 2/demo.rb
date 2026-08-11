# song1 = Song.new("Ruby Tuesday")
# song2 = Song.new("Enveloped in Python")

puts "gin joint".length
puts "Rick".index("c")
puts 42.even?
# puts sam.play(song)

num = -1234 # => -1234
positive = num.abs # => 1234


# Basic Ruby

def say_goodnight(name)
  result = "Good night, " + name
  return result
end

puts say_goodnight("John-Boy")
puts say_goodnight("Mary-Ellen")

puts "And good night,\nGrandma"

def say_goodnight(name)
  result = "Good night, #{name}"
  return result
end

puts say_goodnight('Pa')

def say_goodnight(name)
  result = "Good night, #{name.capitalize}"
  return result
end

puts say_goodnight('uncle')

def say_goodnight(name)
  "Good night, #{name.capitalize}"
end

puts say_goodnight('ma')