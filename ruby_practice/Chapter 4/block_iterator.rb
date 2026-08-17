[1, 2, 3, 4].each do |value|
  puts value * value
end
 
squares = [1, 2, 3, 4].map { |value| value * value }
puts squares.inspect
 
sum = [1, 3, 5, 7].inject(0) { |total, element| total + element }
puts sum