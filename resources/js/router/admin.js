import Index from '../views/Admin/Index'
import AdminIndex from '../views/Administration/AdminIndex'
import IconsIndex from '../views/Administration/Icons/IconsIndex'
import AddIcon from '../views/Administration/Icons/AddIcon'
import FramesIndex from '../views/Administration/Frames/FramesIndex'
import AddFrame from '../views/Administration/Frames/AddFrame'

import DesignIndex from '../views/Administration/Designs/DesignIndex'
import AddDesign from '../views/Administration/Designs/AddDesign'

const meta = {
    auth:false,
    guest:false,
    admin:true,
}

const admin = [
    {
        path:'/admin',
        name:"AdminHome",
        component:Index,
        meta:meta
    },
    {
        path:'/administration',
        name:"Administration",
        component:AdminIndex,
        meta:meta,
        children:[
            {
                path:'icons',
                name:"AdminIconsIndex",
                meta:meta,
                component:IconsIndex,
            },
            {
                path:'icons/add',
                name:"AddIcon",
                meta:meta,
                component:AddIcon,                
            },
            {
                path:'frames',
                name:"FramesIndex",
                meta:meta,
                component:FramesIndex,                
            },
            {
                path:'frames/add',
                name:"AddFrame",
                meta:meta,
                component:AddFrame,                
            },
            {
                path:'designs',
                name:"DesignsIndex",
                meta:meta,
                component:DesignIndex,                
            },
            {
                path:'designs/add',
                name:"AddDesign",
                meta:meta,
                component:AddDesign,                
            },
        ]
    },
];
export default admin;