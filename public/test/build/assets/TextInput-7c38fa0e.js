import{k as n,q as r,o as l,f as d}from"./app-1aca18b0.js";const p=["value"],m={__name:"TextInput",props:["modelValue"],emits:["update:modelValue"],setup(o,{expose:t}){const e=n(null);return r(()=>{e.value.hasAttribute("autofocus")&&e.value.focus()}),t({focus:()=>e.value.focus()}),(a,u)=>(l(),d("input",{class:"border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm",value:o.modelValue,onInput:u[0]||(u[0]=s=>a.$emit("update:modelValue",s.target.value)),ref_key:"input",ref:e},null,40,p))}};export{m as _};
