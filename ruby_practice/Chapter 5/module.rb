module Debug
  def who_am_i?
    "#{self.class.name} (id: #{self.object_id})"
  end
end
 
class Phonograph
  include Debug
end
 
class EightTrack
  include Debug
end
 
ph = Phonograph.new
et = EightTrack.new
puts ph.who_am_i?
puts et.who_am_i?