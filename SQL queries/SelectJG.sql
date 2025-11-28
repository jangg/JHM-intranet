select person.voornaam, person.tussenvoegsels, person.achternaam 
from person, werkzkd
where werkzkd.id_jobgroup = '5' and werkzkd.id_person = person.person_id;