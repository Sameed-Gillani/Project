NORTH = 1
EAST = 2
SOUTH = 3
WEST = 4

# walk(NORTH)
# look(EAST)

# walk(:north)
# look(:east)

def walk(direction)
  if direction == :north
    puts "Walking north"
  end
end

walk(:north)

inst_section = {
  :cello => 'string',
  :clarinet => 'woodwind',
  :drum => 'percussion',
  :oboe => 'woodwind',
  :trumpet => 'brass',
  :violin => 'string'
}

p inst_section[:oboe]   # => "woodwind"
p inst_section[:cello]  # => "string"
# Note that strings aren't the same as symbols...
p inst_section['cello'] # => nil

inst_section = {
  cello: 'string',
  clarinet: 'woodwind',
  drum: 'percussion',
  oboe: 'woodwind',
  trumpet: 'brass',
  violin: 'string'
}

puts "An oboe is a #{inst_section[:oboe]} instrument"