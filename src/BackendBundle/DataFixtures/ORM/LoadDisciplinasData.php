<?php

namespace BackendBundle\Entity;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use BackendBundle\Entity\Disciplinas;

class LoadDisciplinasData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
       $disciplina = new Disciplinas();
       $disciplina->setNombre("Ajedrez Masculino");
       $disciplina->setLogo("ajedrez.png");
       $manager->persist($disciplina);

  $disciplina = new Disciplinas();
       $disciplina->setNombre("Ajedrez Femenino");
       $disciplina->setLogo("ajedrez.png");
       $manager->persist($disciplina);

 $disciplina = new Disciplinas();
       $disciplina->setNombre("Atletismo Masculino");
       $disciplina->setLogo("atletismo.png");
       $manager->persist($disciplina);

 $disciplina = new Disciplinas();
       $disciplina->setNombre("Atletismo Femenino");
       $disciplina->setLogo("atletismo.png");
       $manager->persist($disciplina);

 $disciplina = new Disciplinas();
       $disciplina->setNombre("Baloncesto Masculino");
       $disciplina->setLogo("Basketball,.png");
       $manager->persist($disciplina);

$disciplina = new Disciplinas();
       $disciplina->setNombre("Baloncesto Femenino");
       $disciplina->setLogo("Basketball,.png");
       $manager->persist($disciplina);

$disciplina = new Disciplinas();
       $disciplina->setNombre("Béisbol");
       $disciplina->setLogo("BaseBall.png");
       $manager->persist($disciplina);      

$disciplina = new Disciplinas();
       $disciplina->setNombre("Ciclismo Masculino");
       $disciplina->setLogo("Cycling.png");
       $manager->persist($disciplina);

$disciplina = new Disciplinas();
       $disciplina->setNombre("Ciclismo Femenino");
       $disciplina->setLogo("Cycling.png");
       $manager->persist($disciplina);

$disciplina = new Disciplinas();
       $disciplina->setNombre("Esgrima Masculino");
       $disciplina->setLogo("esgrima.png");
       $manager->persist($disciplina);

$disciplina = new Disciplinas();
       $disciplina->setNombre("Esgrima Femenino");
       $disciplina->setLogo("esgrima.png");
       $manager->persist($disciplina);

 $disciplina = new Disciplinas();
       $disciplina->setNombre("Fútbol Masculino");
       $disciplina->setLogo("futbol.png");
       $manager->persist($disciplina);

 $disciplina = new Disciplinas();
       $disciplina->setNombre("Fútbol Femenino");
       $disciplina->setLogo("futbol.png");
       $manager->persist($disciplina);

 $disciplina = new Disciplinas();
       $disciplina->setNombre("Fútbol Sala Masculino");
       $disciplina->setLogo("futbol-sala.png");
       $manager->persist($disciplina);

 $disciplina = new Disciplinas();
       $disciplina->setNombre("Fútbol Sala Femenino");
       $disciplina->setLogo("futbol-sala.png");
       $manager->persist($disciplina);

$disciplina = new Disciplinas();
       $disciplina->setNombre("Judo Masculino");
       $disciplina->setLogo("judo.png");
       $manager->persist($disciplina);

       $disciplina = new Disciplinas();
       $disciplina->setNombre("Judo Femenino");
       $disciplina->setLogo("judo.png");
       $manager->persist($disciplina);

	   $disciplina = new Disciplinas();
       $disciplina->setNombre("Karate Do Masculino");
       $disciplina->setLogo("karate.png");
       $manager->persist($disciplina);

       $disciplina = new Disciplinas();
       $disciplina->setNombre("Karate Do Femenino");
       $disciplina->setLogo("karate.png");
       $manager->persist($disciplina);

       $disciplina = new Disciplinas();
       $disciplina->setNombre("kickingball");
       $disciplina->setLogo("kickingball.png");
       $manager->persist($disciplina);

       $disciplina = new Disciplinas();
       $disciplina->setNombre("Levantamiento de Pesas Masculino");
       $disciplina->setLogo("pesas.png");
       $manager->persist($disciplina);

       $disciplina = new Disciplinas();
       $disciplina->setNombre("Levantamiento de Pesas Femenino");
       $disciplina->setLogo("pesas.png");
       $manager->persist($disciplina);

       $disciplina = new Disciplinas();
       $disciplina->setNombre("Lucha Olimpica Masculino");
       $disciplina->setLogo("lucha.png");
       $manager->persist($disciplina);

       $disciplina = new Disciplinas();
       $disciplina->setNombre("Lucha Olimpica Femenino");
       $disciplina->setLogo("lucha.png");
       $manager->persist($disciplina);

       $disciplina = new Disciplinas();
       $disciplina->setNombre("Natación Masculino");
       $disciplina->setLogo("natacion.png");
       $manager->persist($disciplina);

       $disciplina = new Disciplinas();
       $disciplina->setNombre("Natación Femenino");
       $disciplina->setLogo("natacion.png");
       $manager->persist($disciplina);

       $disciplina = new Disciplinas();
       $disciplina->setNombre("Sóftbol Masculino");
       $disciplina->setLogo("softboll.png");
       $manager->persist($disciplina);

      $disciplina = new Disciplinas();
       $disciplina->setNombre("Sóftbol Femenino");
       $disciplina->setLogo("softboll.png");
       $manager->persist($disciplina);

       $disciplina = new Disciplinas();
       $disciplina->setNombre("Taekwondo Masculino");
       $disciplina->setLogo("taekwondo.png");
       $manager->persist($disciplina);

       $disciplina = new Disciplinas();
       $disciplina->setNombre("Taekwondo Femenino");
       $disciplina->setLogo("taekwondo.png");
       $manager->persist($disciplina);

       $disciplina = new Disciplinas();
       $disciplina->setNombre("Tenis Masculino");
       $disciplina->setLogo("tenis.png");
       $manager->persist($disciplina);

       $disciplina = new Disciplinas();
       $disciplina->setNombre("Tenis Femenino");
       $disciplina->setLogo("tenis.png");
       $manager->persist($disciplina);

       $disciplina = new Disciplinas();
       $disciplina->setNombre("Tenis de Mesa Masculino");
       $disciplina->setLogo("tenis-mesa.png");
       $manager->persist($disciplina);

       $disciplina = new Disciplinas();
       $disciplina->setNombre("Tenis de Mesa Femenino");
       $disciplina->setLogo("tenis-mesa.png");
       $manager->persist($disciplina);

       $disciplina = new Disciplinas();
       $disciplina->setNombre("Voleibol de Arena Masculino");
       $disciplina->setLogo("voleibol-arena.png");
       $manager->persist($disciplina);

       $disciplina = new Disciplinas();
       $disciplina->setNombre("Voleibol de Arena Femenino");
       $disciplina->setLogo("voleibol-arena.png");
       $manager->persist($disciplina);

       $disciplina = new Disciplinas();
       $disciplina->setNombre("Voleibol Masculino");
       $disciplina->setLogo("voleibol.png");
       $manager->persist($disciplina);

       $disciplina = new Disciplinas();
       $disciplina->setNombre("Voleibol Femenino");
       $disciplina->setLogo("voleibol.png");
       $manager->persist($disciplina);

       $manager->flush();
    }

    public function getOrder()
    {
        return 1;
    }
}