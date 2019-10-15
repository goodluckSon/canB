import Profile from '../views/Profile'
import Logout from '../views/Logout'
import Drafts from '../views/Drafts'
import History from '../views/History'
import UserEditor from '../components/UserEditor'
import AddressView from '../components/AddressView'
import AddAddress from '../components/AddAddress'
import Create from '../views/Create'
import Payment from '../views/Payment'
const meta = {
    auth:true,
    guest:false,
}
const app = [
    {
        path:'/logout',
        component:Logout,
        meta:meta,
    },    
    {
        path:'/edit/:id/',
        component:Create,
        meta:meta,
    },    
    {
        path:'/payment',
        component:Payment,
        meta:meta,
    },    
    {
        path:'/profile',
        component:Profile,
        meta:meta,
        children:[
            {
                path:'address',
                component:AddressView,
                meta:meta,
            },            
            {
                path:'address/create',
                component:AddAddress,
                meta:meta,
            },            
            {
                path:'address/:id/update',
                component:AddAddress,
                meta:meta,
            },            
            {
                path:'drafts',
                component:Drafts,
                meta:meta,
            },            
            {
                path:'history',
                component:History,
                meta:meta,
            },            
            {
                path:'/',
                component:UserEditor,
                meta:meta,
            },            
          
        ]
    },
];
export default app;