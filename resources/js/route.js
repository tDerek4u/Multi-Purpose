import Dashboard from './components/Dashboard.vue'
import Appointments from './pages/Appointments.vue'
import Users from './pages/Users.vue'
import Profile from './pages/Profile.vue'
import Settings from './pages/Settings.vue'


export default [
    {
        path : '/admin/dashboard',
        name : 'admin.dashboard',
        component : Dashboard,
    },
    {
        path : '/admin/appointments',
        name : 'admin.appointments',
        component : Appointments,
    },
    {
        path : '/admin/users',
        name : 'admin.users',
        component : Users,
    },
    {
        path : '/admin/settings',
        name : 'admin.settings',
        component : Settings,
    },
    {
        path : '/admin/profile',
        name : 'admin.profile',
        component : Profile,
    }
]


