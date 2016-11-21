<?php

namespace BackendBundle\Entity;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use BackendBundle\Entity\Organizaciones;

class LoadOrganizacionesData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
       $deportesTinn = new Organizaciones();
       $deportesTinn->setNombre("Universidad Nacional Experimental del Yaracuy");
       $deportesTinn->setAbreviatura("UNEY");
       $deportesTinn->setLogo("UNEY.png");
       $deportesTinn->setRif("G-2000840-7");
       $deportesTinn->setTelefono("02542313983");
       $deportesTinn->setEmail("prodeuney2015@gmail.com");
       $deportesTinn->setResponsable("Msc. Ender David Graterol Hernández");
       $deportesTinn->setDireccion("Zona Industrial “Agustín Rivero Calle 1 Edificio Ciepe 2do Piso");
       $deportesTinn->setCampeonato($this->getReference('campeonato'));  $manager->persist($deportesTinn);

       $deportesTinn = new Organizaciones();
       $deportesTinn->setNombre("Colegio Universitario de Caracas");
       $deportesTinn->setAbreviatura("CUC");
       $deportesTinn->setLogo("CUC.png");
       $deportesTinn->setRif("G-20000080-5");
       $deportesTinn->setTelefono("02122086644");
       $deportesTinn->setEmail("coordinaciondedeportescuc@gmail.com");
       $deportesTinn->setResponsable("Miguel Antonio Alvarez Cadiz");
       $deportesTinn->setDireccion("La Floresta, Avenida Principal,Edif Sucre -Municipio- Chacao-Altamira");
       $deportesTinn->setCampeonato($this->getReference('campeonato'));  $manager->persist($deportesTinn);

       $deportesTinn = new Organizaciones();
       $deportesTinn->setNombre("Universidad Nacional Experimental de Guayana");
       $deportesTinn->setAbreviatura("UNEG");
       $deportesTinn->setLogo("UNEG.png");
       $deportesTinn->setRif("G-20003343-6");
       $deportesTinn->setTelefono("04148857514");
       $deportesTinn->setEmail("deporte@uneg.edu.ve");
       $deportesTinn->setResponsable("Lcdo. Jesús Bastardo Aliendres");
       $deportesTinn->setDireccion("Av. Las Américas, Edificio General De Seguros");
       $deportesTinn->setCampeonato($this->getReference('campeonato'));  $manager->persist($deportesTinn);

       $deportesTinn = new Organizaciones();
       $deportesTinn->setNombre("Universidad Nacional Experimental Francisco de Miranda");
       $deportesTinn->setAbreviatura("UNEFM");
       $deportesTinn->setLogo("UNEFM.png");
       $deportesTinn->setRif("G-20005868-4");
       $deportesTinn->setTelefono("02682524918 ");
       $deportesTinn->setEmail("deportesunefm@gmail.com");
       $deportesTinn->setResponsable("Lcdo. Pedro Veliz");
       $deportesTinn->setDireccion("Calle Norte, Entre Avenida Manaure y Calle Toledo, Edificio Rectorado, Santa Ana de Coro, Estado Falcón");
       $deportesTinn->setCampeonato($this->getReference('campeonato'));  $manager->persist($deportesTinn);

       $deportesTinn = new Organizaciones();
       $deportesTinn->setNombre("Universidad Pedagógica Experimental Libertador");
       $deportesTinn->setAbreviatura("UPEL");
       $deportesTinn->setLogo("UPEL.png");
       $deportesTinn->setRif("G-20008202-0");
       $deportesTinn->setTelefono("04166300346");
       $deportesTinn->setEmail("rauseor@gmail.com");
       $deportesTinn->setResponsable("Doctor Régulo Rauseo");
       $deportesTinn->setDireccion("Parque Del Oeste, Avenida Sucre Catia, Distrito Capital");
       $deportesTinn->setCampeonato($this->getReference('campeonato'));  $manager->persist($deportesTinn);

       $deportesTinn = new Organizaciones();
       $deportesTinn->setNombre("Universidad Politecnica Territorial de Yaracuy Aristides Bastidas");
       $deportesTinn->setAbreviatura("UPTYAB");
       $deportesTinn->setLogo("UPTYAB.png");
       $deportesTinn->setRif("G-20012118-1");
       $deportesTinn->setTelefono("02542313168");
       $deportesTinn->setEmail("ramirezch.danny@gmail.com");
       $deportesTinn->setResponsable("Danny Andrés Ramírez Chacón");
       $deportesTinn->setDireccion("Av. Alberto Ravell, Cruce con Av. José Antonio Páez, Frente a Farmatodo Municipio  Independencia, San Felipe, Estado Yaracuy");
       $deportesTinn->setCampeonato($this->getReference('campeonato'));  $manager->persist($deportesTinn);

       $deportesTinn = new Organizaciones();
       $deportesTinn->setNombre("Universidad Politecnica Territorial de Paria “ Luis Mariano Rivera");
       $deportesTinn->setAbreviatura("UPTPLMR");
       $deportesTinn->setLogo("UPTPLMR.png");
       $deportesTinn->setRif("G-20010217-9");
       $deportesTinn->setTelefono("04164980074");
       $deportesTinn->setEmail("krunesr1@gmail.com");
       $deportesTinn->setResponsable("Carlos Alberto Felce Rodriguez");
       $deportesTinn->setDireccion("Carretera Nacional Carùpano-Guiria Sector Charallave Carùpano, Estado - Sucre");
       $deportesTinn->setCampeonato($this->getReference('campeonato'));  $manager->persist($deportesTinn);

       $deportesTinn = new Organizaciones();
       $deportesTinn->setNombre("Instituto Universitario de Tecnologia Agro Industrial");
       $deportesTinn->setAbreviatura("IUTAI");
       $deportesTinn->setLogo("IUTAI.png");
       $deportesTinn->setRif("G-20000243-3");
       $deportesTinn->setTelefono("02763465260");
       $deportesTinn->setEmail("hanchero03@hotmail.com ");
       $deportesTinn->setResponsable("Handersom Perez ");
       $deportesTinn->setDireccion("Avenida Teotimo de Pablo Antiguo Parque Exposicion La Concordia San Cristobal Estado Tachira");
       $deportesTinn->setCampeonato($this->getReference('campeonato'));  $manager->persist($deportesTinn);

       $deportesTinn = new Organizaciones();
       $deportesTinn->setNombre("Instituto Universitario de Tecnología del Oeste Mariscal Sucre");
       $deportesTinn->setAbreviatura("IUTOMS");
       $deportesTinn->setLogo("IUTOMS.png");
       $deportesTinn->setRif("G-00000000-0");
       $deportesTinn->setTelefono("04263108800");
       $deportesTinn->setEmail("coordinaiutoms@gmail.com");
       $deportesTinn->setResponsable("David Silva Prades");
       $deportesTinn->setDireccion("Antiguo Edificio Fosforera- Antimano - Distrito Capital");
       $deportesTinn->setCampeonato($this->getReference('campeonato'));  $manager->persist($deportesTinn);

       $deportesTinn = new Organizaciones();
       $deportesTinn->setNombre("Universidad Politecnica Territorial del Norte del Tachira Manuela Saenz");
       $deportesTinn->setAbreviatura("UPTNTMS");
       $deportesTinn->setLogo("UPTNTMS.png");
       $deportesTinn->setRif("G-20009572-5");
       $deportesTinn->setTelefono("04145310955");
       $deportesTinn->setEmail("jesuspabon2009@gmail.com");
       $deportesTinn->setResponsable("Jesus Manuel Rivera Pabon");
       $deportesTinn->setDireccion("Zona Industrial, Antiguo Edificio Conditaca, Al Lado del Seguro Social. La Fría Estado Táchira");
       $deportesTinn->setCampeonato($this->getReference('campeonato'));  $manager->persist($deportesTinn);

       $deportesTinn = new Organizaciones();
       $deportesTinn->setNombre("Universidad Nacional Experimental de las Artes");
       $deportesTinn->setAbreviatura("UNEARTE");
       $deportesTinn->setLogo("Unearte.JPG");
       $deportesTinn->setRif("G-20008463-4");
       $deportesTinn->setTelefono("04166060246");
       $deportesTinn->setEmail("franciscojlopez@unearte.edu.ve");
       $deportesTinn->setResponsable("Francisco López");
       $deportesTinn->setDireccion("Edificio Unearte, Cruce con Av. México, Con Av. Norte-Sur 25, Urb. El Conde, Parroquia San Agustín, Plaza Morelos");
       $deportesTinn->setCampeonato($this->getReference('campeonato'));  $manager->persist($deportesTinn);

       $deportesTinn = new Organizaciones();
       $deportesTinn->setNombre("Misión Sucre");
       $deportesTinn->setAbreviatura("MS");
       $deportesTinn->setLogo("MS.png");
       $deportesTinn->setRif("G-2003871-3");
       $deportesTinn->setTelefono("04242247007");
       $deportesTinn->setEmail("leonardojvs@yahoo.es");
       $deportesTinn->setResponsable("Leonardo Villamizar");
       $deportesTinn->setDireccion("Sin Información");
       $deportesTinn->setCampeonato($this->getReference('campeonato'));  $manager->persist($deportesTinn);

       $deportesTinn = new Organizaciones();
       $deportesTinn->setNombre("Universidad Politécnica Territorial del Estado Portugues 'Juan De Jesús Montilla'");
       $deportesTinn->setAbreviatura("UPTPJJM");
       $deportesTinn->setLogo("UPTPJJM.png");
       $deportesTinn->setRif("G-20010200-4");
       $deportesTinn->setTelefono("02556237538");
       $deportesTinn->setEmail("betcarisa@hotmail.com");
       $deportesTinn->setResponsable("Leonardo Morales");
       $deportesTinn->setDireccion("Av. Circunvalacion Sur Diagonal a la Cruz Roja Acarigua ");
       $deportesTinn->setCampeonato($this->getReference('campeonato'));  $manager->persist($deportesTinn);

       $deportesTinn = new Organizaciones();
       $deportesTinn->setNombre("Universidad Politécnica Territorial de los Altos Mirandinos “Cecilio Acosta”");
       $deportesTinn->setAbreviatura("UPTAMCA");
       $deportesTinn->setLogo("UPTAMCA.png");
       $deportesTinn->setRif("G-20011321-9");
       $deportesTinn->setTelefono("02123224828");
       $deportesTinn->setEmail("unidereextensionuniversitaria@gmail.com");
       $deportesTinn->setResponsable("Prof. Ludwig Serni");
       $deportesTinn->setDireccion("Km 23 Carretera Panamericana, Sector Macarena Norte, Parroquia El Vigía, Municipio Guaicaipuro, Estado Miranda");
       $deportesTinn->setCampeonato($this->getReference('campeonato'));  $manager->persist($deportesTinn);

       $deportesTinn = new Organizaciones();
       $deportesTinn->setNombre(" Universidad Nacional Experimental Politécnica De La Fuerza Armada Nacional");
       $deportesTinn->setAbreviatura("UNEFA");
       $deportesTinn->setLogo("UNEFA.png");
       $deportesTinn->setRif("G-20006297-5");
       $deportesTinn->setTelefono("04264120498");
       $deportesTinn->setEmail("echunefadep16@gmail.com ");
       $deportesTinn->setResponsable("Prof. Edgar Ramón Charris");
       $deportesTinn->setDireccion("Av. La Estancia con Av. Caracas y Calle Holanda. Chuao. Edif. Sede UNEFA. Frente a Torre Banaven. Municipio Baruta. Parroquia El Cafetal.");
       $deportesTinn->setCampeonato($this->getReference('campeonato'));  $manager->persist($deportesTinn);

       $deportesTinn = new Organizaciones();
       $deportesTinn->setNombre("Escuela Nacional de Administración Y Hacienda Pública.");
       $deportesTinn->setAbreviatura("ENAHP");
       $deportesTinn->setLogo("ENAHP.png");
       $deportesTinn->setRif("G-200105313");
       $deportesTinn->setTelefono("04167178807");
       $deportesTinn->setEmail("deportenahp@gmail.com");
       $deportesTinn->setResponsable("Prof. Miguel Resplandor");
       $deportesTinn->setDireccion("Av. Francisco de Miranda, Edif. Enahp, Los Ruices Estado Miranda.");
       $deportesTinn->setCampeonato($this->getReference('campeonato'));  $manager->persist($deportesTinn);

       $deportesTinn = new Organizaciones();
       $deportesTinn->setNombre("Universidad Nacional Experimental 'Rafael Maria Baralt'");
       $deportesTinn->setAbreviatura("UNERMB");
       $deportesTinn->setLogo("UNERMB.jpg");
       $deportesTinn->setRif("G-20000069-4");
       $deportesTinn->setTelefono("04246210834");
       $deportesTinn->setEmail("otonierdavid@gmail.com");
       $deportesTinn->setResponsable("Otonier D. Jimenez M.");
       $deportesTinn->setDireccion("Av. Principal de Cabimas  Diagonal a la Catedral de Cabimas Edif. Control de Estudio Antiguo Banco de Maracaibo.");
       $deportesTinn->setCampeonato($this->getReference('campeonato'));  $manager->persist($deportesTinn);
       

       $manager->flush();
    }

    public function getOrder()
    {
        return 5;
    }
}