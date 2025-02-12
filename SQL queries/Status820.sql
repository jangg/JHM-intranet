SELECT person.voornaam, person.tussenvoegsels, person.achternaam, processtap.wzstatus as statuscode , processtap.dt_stap as datumtijd, user. username
FROM werkzkd, person, processtap, user
WHERE person.person_id = werkzkd.id_person AND
werkzkd.id = processtap.id_werkzkd AND person.delind = 'n'  AND processtap.wzstatus = '820' AND processtap.id_user = user.id
ORDER BY person.achternaam, processtap.wzstatus;