select person.achternaam, processtap.wzstatus, wkzstatus.omschrijving, processtap.dt_stap  
from processtap, werkzkd, person, wkzstatus
where  processtap.id_werkzkd = werkzkd.id and werkzkd.id_person = person.person_id and werkzkd.status < '600'
and processtap.wzstatus = wkzstatus.code
order by person.achternaam, processtap.dt_stap;