import random

Nombres = ["Juan", "Pedro", "Luis", "Santiago", "Carlos", "Daniel", "Pablo", "Mario", "Jose", "Josue",
           "Maria", "Margarita", "Ester", "Rut", "Nohemi", "Diana", "Gloria", "Rebeca", "Laura", "Sara"]
Apellidos = ["Collazo", "Martis", "De La Cruz", "Natera", "Ramirez", "Calderon", "Mere", "Diaz", "Falcon", "Rivera",
             "De La Cruz", "Motta", "Estevez", "Davila", "Del Valle", "Colton", "Rios", "Rubio", "De Jesus", "De La Barca"]
Cuantos = input("Cuantos datos insertaras? ")
id = int(input("Desde que numero van los id? "))

print "INSERT INTO estudiante VALUES ",
for i in range(0, Cuantos):
	num1 = random.randint(0,19)
	num2 = random.randint(0,19)
	num3 = ((num2 + random.randint(1,19))%20)
	name = "\"" + Nombres[num1] + " " + Apellidos[num2] + " " + Apellidos[num3] + "\""
        ent  = random.randint(0, 1)
        year = random.randint(2000, 2013)
	fec1 = "\"08/15/" + str(year) + "\""
	fec2 = "\"05/13/" + str(year+3) + "\""
	print "("+name+", "+str(ent)+", "+fec1+", "+fec2+", \""+str(id)+"\")",
	id = id + 1
        if i == (Cuantos-1):
		print ";"
        else:
		print ", "
