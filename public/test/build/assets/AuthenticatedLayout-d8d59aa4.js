import{A as D}from"./ApplicationLogo-d14d63bb.js";import{q as N,s as B,h as v,k as M,o as d,f as g,b as e,A as c,i as $,M as C,a,w as o,n as u,K as j,c as w,u as b,j as _,d as r,t as y,g as E}from"./app-1aca18b0.js";const z={class:"relative"},A={__name:"Dropdown",props:{align:{default:"right"},width:{default:"48"},contentClasses:{default:()=>["py-1","bg-white"]}},setup(n){const s=n,t=p=>{l.value&&p.key==="Escape"&&(l.value=!1)};N(()=>document.addEventListener("keydown",t)),B(()=>document.removeEventListener("keydown",t));const i=v(()=>({48:"w-48"})[s.width.toString()]),m=v(()=>s.align==="left"?"origin-top-left left-0":s.align==="right"?"origin-top-right right-0":"origin-top"),l=M(!1);return(p,f)=>(d(),g("div",z,[e("div",{onClick:f[0]||(f[0]=k=>l.value=!l.value)},[c(p.$slots,"trigger")]),$(e("div",{class:"fixed inset-0 z-40",onClick:f[1]||(f[1]=k=>l.value=!1)},null,512),[[C,l.value]]),a(j,{"enter-active-class":"transition ease-out duration-200","enter-from-class":"transform opacity-0 scale-95","enter-to-class":"transform opacity-100 scale-100","leave-active-class":"transition ease-in duration-75","leave-from-class":"transform opacity-100 scale-100","leave-to-class":"transform opacity-0 scale-95"},{default:o(()=>[$(e("div",{class:u(["absolute z-50 mt-2 rounded-md shadow-lg",[i.value,m.value]]),style:{display:"none"},onClick:f[2]||(f[2]=k=>l.value=!1)},[e("div",{class:u(["rounded-md ring-1 ring-black ring-opacity-5",n.contentClasses])},[c(p.$slots,"content")],2)],2),[[C,l.value]])]),_:3})]))}},L={__name:"DropdownLink",setup(n){return(s,t)=>(d(),w(b(_),{class:"block w-full px-4 py-2 text-left text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out"},{default:o(()=>[c(s.$slots,"default")]),_:3}))}},x={__name:"NavLink",props:["href","active"],setup(n){const s=n,t=v(()=>s.active?"inline-flex items-center px-1 pt-1 border-b-2 border-indigo-400 text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out":"inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out");return(i,m)=>(d(),w(b(_),{href:n.href,class:u(t.value)},{default:o(()=>[c(i.$slots,"default")]),_:3},8,["href","class"]))}},h={__name:"ResponsiveNavLink",props:["href","active"],setup(n){const s=n,t=v(()=>s.active?"block w-full pl-3 pr-4 py-2 border-l-4 border-indigo-400 text-left text-base font-medium text-indigo-700 bg-indigo-50 focus:outline-none focus:text-indigo-800 focus:bg-indigo-100 focus:border-indigo-700 transition duration-150 ease-in-out":"block w-full pl-3 pr-4 py-2 border-l-4 border-transparent text-left text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out");return(i,m)=>(d(),w(b(_),{href:n.href,class:u(t.value)},{default:o(()=>[c(i.$slots,"default")]),_:3},8,["href","class"]))}},S={class:"min-h-screen bg-gray-100"},V={class:"bg-white border-b border-gray-100"},O={class:"max-w-7xl mx-auto px-4 sm:px-6 lg:px-8"},U={class:"flex justify-between h-16"},P={class:"flex"},T={class:"shrink-0 flex items-center"},q={class:"hidden space-x-8 sm:-my-px sm:ml-10 sm:flex"},K={class:"hidden space-x-8 sm:-my-px sm:ml-10 sm:flex"},R={class:"hidden space-x-8 sm:-my-px sm:ml-10 sm:flex"},F={class:"hidden sm:flex sm:items-center sm:ml-6"},G={class:"ml-3 relative"},H={class:"inline-flex rounded-md"},I={type:"button",class:"inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"},J=e("svg",{class:"ml-2 -mr-0.5 h-4 w-4",xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 20 20",fill:"currentColor"},[e("path",{"fill-rule":"evenodd",d:"M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z","clip-rule":"evenodd"})],-1),Q={class:"-mr-2 flex items-center sm:hidden"},W={class:"h-6 w-6",stroke:"currentColor",fill:"none",viewBox:"0 0 24 24"},X={class:"pt-2 pb-3 space-y-1"},Y={class:"pt-2 pb-3 space-y-1"},Z={class:"pt-2 pb-3 space-y-1"},ee={class:"pt-4 pb-1 border-t border-gray-200"},te={class:"px-4"},se={class:"font-medium text-base text-gray-800"},oe={class:"font-medium text-sm text-gray-500"},ae={class:"mt-3 space-y-1"},re={key:0,class:"bg-white shadow"},ne={class:"max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8"},de={__name:"AuthenticatedLayout",setup(n){const s=M(!1);return(t,i)=>(d(),g("div",null,[e("div",S,[e("nav",V,[e("div",O,[e("div",U,[e("div",P,[e("div",T,[a(b(_),{href:t.route("dashboard")},{default:o(()=>[a(D,{class:"block h-9 w-auto fill-current text-gray-800"})]),_:1},8,["href"])]),e("div",q,[a(x,{href:t.route("dashboard"),active:t.route().current("dashboard")},{default:o(()=>[r(" Dashboard ")]),_:1},8,["href","active"])]),e("div",K,[a(x,{href:t.route("message.create"),active:t.route().current("message.create")},{default:o(()=>[r(" Create Message ")]),_:1},8,["href","active"])]),e("div",R,[a(x,{href:t.route("users"),active:t.route().current("users")},{default:o(()=>[r(" Users ")]),_:1},8,["href","active"])])]),e("div",F,[e("div",G,[a(A,{align:"right",width:"48"},{trigger:o(()=>[e("span",H,[e("button",I,[r(y(t.$page.props.auth.user.name)+" ",1),J])])]),content:o(()=>[a(L,{href:t.route("profile.edit")},{default:o(()=>[r(" Profile ")]),_:1},8,["href"]),a(L,{href:t.route("logout"),method:"post",as:"button"},{default:o(()=>[r(" Log Out ")]),_:1},8,["href"])]),_:1})])]),e("div",Q,[e("button",{onClick:i[0]||(i[0]=m=>s.value=!s.value),class:"inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out"},[(d(),g("svg",W,[e("path",{class:u({hidden:s.value,"inline-flex":!s.value}),"stroke-linecap":"round","stroke-linejoin":"round","stroke-width":"2",d:"M4 6h16M4 12h16M4 18h16"},null,2),e("path",{class:u({hidden:!s.value,"inline-flex":s.value}),"stroke-linecap":"round","stroke-linejoin":"round","stroke-width":"2",d:"M6 18L18 6M6 6l12 12"},null,2)]))])])])]),e("div",{class:u([{block:s.value,hidden:!s.value},"sm:hidden"])},[e("div",X,[a(h,{href:t.route("dashboard"),active:t.route().current("dashboard")},{default:o(()=>[r(" Dashboard ")]),_:1},8,["href","active"])]),e("div",Y,[a(h,{href:t.route("message.create"),active:t.route().current("message.create")},{default:o(()=>[r(" Create Message ")]),_:1},8,["href","active"])]),e("div",Z,[a(h,{href:t.route("users"),active:t.route().current("users")},{default:o(()=>[r(" Users ")]),_:1},8,["href","active"])]),e("div",ee,[e("div",te,[e("div",se,y(t.$page.props.auth.user.name),1),e("div",oe,y(t.$page.props.auth.user.email),1)]),e("div",ae,[a(h,{href:t.route("profile.edit")},{default:o(()=>[r(" Profile ")]),_:1},8,["href"]),a(h,{href:t.route("logout"),method:"post",as:"button"},{default:o(()=>[r(" Log Out ")]),_:1},8,["href"])])])],2)]),t.$slots.header?(d(),g("header",re,[e("div",ne,[c(t.$slots,"header")])])):E("",!0),e("main",null,[c(t.$slots,"default")])])]))}};export{de as _};
