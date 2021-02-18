<?php


namespace App\Controller;

use App\Entity\Experience;
use App\Entity\School;
use App\Entity\Skills;
use App\Form\ExperienceType;
use App\Form\SchoolType;
use App\Form\SkillsType;
use App\Repository\ExperienceRepository;
use App\Repository\SchoolRepository;
use App\Repository\SkillsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


class AdminController extends AbstractController
{
//    Home page part
    /**
     * @Route("/", name="homepage", methods={"GET"})
     */
    public function homepage() {

        return $this->render('home/index.html.twig', []
        );
    }
//    Security Part
    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
// Experience Part
    /**
     * @Route("/experience", name="experience_index", methods={"GET"})
     */
    public function indexExperience(ExperienceRepository $experienceRepository): Response
    {
        return $this->render('experience/index.html.twig', [
            'experiences' => $experienceRepository->findAll(),
        ]);
    }

    /**
     * @Route("/experience/new", name="experience_new", methods={"GET","POST"})
     */
    public function newExperience(Request $request): Response
    {
        $experience = new Experience();
        $form = $this->createForm(ExperienceType::class, $experience);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($experience);
            $entityManager->flush();

            return $this->redirectToRoute('experience_index');
        }

        return $this->render('experience/new.html.twig', [
            'experience' => $experience,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/experience/{id}", name="experience_show", methods={"GET"})
     */
    public function showExperience(Experience $experience): Response
    {
        return $this->render('experience/show.html.twig', [
            'experience' => $experience,
        ]);
    }

    /**
     * @Route("/experience/{id}/edit", name="experience_edit", methods={"GET","POST"})
     */
    public function editExperience(Request $request, Experience $experience): Response
    {
        $form = $this->createForm(ExperienceType::class, $experience);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('experience_index');
        }

        return $this->render('experience/edit.html.twig', [
            'experience' => $experience,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/experience/{id}", name="experience_delete", methods={"DELETE"})
     */
    public function deleteExperience(Request $request, Experience $experience): Response
    {
        if ($this->isCsrfTokenValid('delete'.$experience->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($experience);
            $entityManager->flush();
        }

        return $this->redirectToRoute('experience_index');
    }
//    School Part
    /**
     * @Route("/school", name="school_index", methods={"GET"})
     */
    public function indexSchool(SchoolRepository $schoolRepository): Response
    {
        return $this->render('school/index.html.twig', [
            'schools' => $schoolRepository->findAll(),
        ]);
    }

    /**
     * @Route("/school/new", name="school_new", methods={"GET","POST"})
     */
    public function newSchool(Request $request): Response
    {
        $school = new School();
        $form = $this->createForm(SchoolType::class, $school);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($school);
            $entityManager->flush();

            return $this->redirectToRoute('school_index');
        }

        return $this->render('school/new.html.twig', [
            'school' => $school,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/school/{id}", name="school_show", methods={"GET"})
     */
    public function showSchool(School $school): Response
    {
        return $this->render('school/show.html.twig', [
            'school' => $school,
        ]);
    }

    /**
     * @Route("/school/{id}/edit", name="school_edit", methods={"GET","POST"})
     */
    public function editSchool(Request $request, School $school): Response
    {
        $form = $this->createForm(SchoolType::class, $school);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('school_index');
        }

        return $this->render('school/edit.html.twig', [
            'school' => $school,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/school/{id}", name="school_delete", methods={"DELETE"})
     */
    public function deleteSchool(Request $request, School $school): Response
    {
        if ($this->isCsrfTokenValid('delete'.$school->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($school);
            $entityManager->flush();
        }

        return $this->redirectToRoute('school_index');
    }
//    Skills Part
    /**
     * @Route("/skills", name="skills_index", methods={"GET"})
     */
    public function indexSkills(SkillsRepository $skillsRepository): Response
    {
        return $this->render('skills/index.html.twig', [
            'skills' => $skillsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/skills/new", name="skills_new", methods={"GET","POST"})
     */
    public function newSkills(Request $request): Response
    {
        $skill = new Skills();
        $form = $this->createForm(SkillsType::class, $skill);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($skill);
            $entityManager->flush();

            return $this->redirectToRoute('skills_index');
        }

        return $this->render('skills/new.html.twig', [
            'skill' => $skill,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/skills/{id}", name="skills_show", methods={"GET"})
     */
    public function showSkills(Skills $skill): Response
    {
        return $this->render('skills/show.html.twig', [
            'skill' => $skill,
        ]);
    }

    /**
     * @Route("/skills/{id}/edit", name="skills_edit", methods={"GET","POST"})
     */
    public function editSkills(Request $request, Skills $skill): Response
    {
        $form = $this->createForm(SkillsType::class, $skill);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('skills_index');
        }

        return $this->render('skills/edit.html.twig', [
            'skill' => $skill,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/skills/{id}", name="skills_delete", methods={"DELETE"})
     */
    public function deleteSkills(Request $request, Skills $skill): Response
    {
        if ($this->isCsrfTokenValid('delete'.$skill->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($skill);
            $entityManager->flush();
        }

        return $this->redirectToRoute('skills_index');
    }
}