digits = 0..9
puts digits.include?(5)
puts digits.to_a.inspect
 
(1..5).each { |i| print i, " " }
puts
 
car_age = 9.5
case car_age
when 0...1
  puts "Mmm.. new car smell"
when 1...3
  puts "Nice and new"
when 3...10
  puts "Reliable but slightly dinged"
else
  puts "Vintage gem"
end