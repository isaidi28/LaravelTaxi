import { createRouter, createWebHistory } from 'vue-router';  // Importation correcte

//pages
import Dashboard from '../pages/Dashboard.vue';  // Assure-toi que le chemin est correct
import Apropos from '../pages/Apropos.vue';
import Register from '../pages/Register.vue';
import Login from '../pages/Login.vue';
import Home from '../pages/Home.vue';

//components
import Chauffeurs from '../components/Chauffeurs/Chauffeurs.vue';
import ChauffeursCreate from '../components/Chauffeurs/ChauffeursCreate.vue';
import ChauffeursEdit from '../components/Chauffeurs/ChauffeursEdit.vue';
import CoursesEdit from '../components/Courses/CourseEdit.vue';
import Courses from '../components/Courses/Courses.vue';
import CourseDetails from '../components/Courses/CourseDetails.vue';
import ChauffeursDetails from '../components/Chauffeurs/ChauffeursDetails.vue';

const routes = [
    { name: 'home', path: '/', component: Home },
    { name: 'apropos', path: '/apropos', component: Apropos },
    { name: 'register', path: '/register', component: Register },
    { name: 'login', path: '/login', component: Login },
    { name: 'dashboard', path: '/dashboard', component: Dashboard },
    { name: 'chauffeurs', path: '/chauffeurs', component: Chauffeurs },
    { name: 'addChauffeur', path: '/chauffeurs/add', component: ChauffeursCreate }, // Chemin en minuscules
    { name: 'chauffeursEdit', path: '/chauffeurs/edit/:id', component: ChauffeursEdit },
    { name: 'coursesEdit', path: '/courses/edit/:id', component: CoursesEdit }, // Chemin en minuscules
    { name: 'courses', path: '/courses', component: Courses }, // Chemin en minuscules
    { name: 'courses.show', path: '/courses/:id', component: CourseDetails },
    { name: 'chauffeurDetails', path: '/chauffeurs/:id', component: ChauffeursDetails} // Chemin en minuscules

];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
