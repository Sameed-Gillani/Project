p /Perl|Python/
 
p /P(erl|ython)/
 
p /\d\d:\d\d:\d\d/       # a time such as 12:34:56
p /Perl.*Python/         # Perl, zero or more other chars, then Python
p /Perl Python/          # Perl, a space, and Python
p /Perl *Python/         # Perl, zero or more spaces, and Python
p /Perl +Python/         # Perl, one or more spaces, and Python
p /Perl\s+Python/        # Perl, whitespace characters, then Python
p /Ruby (Perl|Python)/   # Ruby, a space, and either Perl or Python
 
line = "I love Perl and Python"
if line =~ /Perl|Python/
  puts "Scripting language mentioned: #{line}"
end
 
line = "I love Perl and Python"
newline = line.sub(/Perl/, 'Ruby')          # replace first 'Perl' with 'Ruby'
newerline = newline.gsub(/Python/, 'Ruby')  # replace every 'Python' with 'Ruby'
puts newerline
 
line = "I love Perl and Python"
newline = line.gsub(/Perl|Python/, 'Ruby')
puts newline
 