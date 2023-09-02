!function(){function t(t,e){function n(){A=document.createElementNS(E,"svg"),A.addEventListener("mousemove",v),t.appendChild(A),p.bgDraw&&(P=document.createElementNS(E,"rect"),P.setAttribute("x",0),P.setAttribute("y",0),P.setAttribute("fill",p.bgColor),A.appendChild(P)),a(),i(),d(),window.addEventListener("resize",y)}function i(){var e=window.innerWidth||document.documentElement.clientWidth||document.body.clientWidth,n=window.innerHeight||document.documentElement.clientHeight||document.body.clientHeight,i=e,r=n;p.width.toString().indexOf("%")>0||p.height.toString().indexOf("%")>0?(i=Math.round(t.offsetWidth/100*parseInt(p.width)),r=Math.round(i/100*parseInt(p.height))):(i=parseInt(p.width),r=parseInt(p.height)),i>=e&&(i=e),r>=n&&(r=n),b={x:i/2,y:r/2},O.x=p.speed/b.x,O.y=p.speed/b.y,w=i>=r?r/100*parseInt(p.radius):i/100*parseInt(p.radius),1>w&&(w=1),x=w/2,x<p.radiusMin&&(x=p.radiusMin,w=2*x),A.setAttribute("width",i),A.setAttribute("height",r),p.bgDraw&&(P.setAttribute("width",i),P.setAttribute("height",r)),o(x)}function o(t){for(var e=0,n=S.length;n>e;e++)r(S[e],t)}function r(t,e){var n=t.vectorPosition.x-C.x,i=t.vectorPosition.y-C.y,o=t.vectorPosition.z-C.z,r=Math.sqrt(n*n+i*i+o*o);t.vectorPosition.x/=r,t.vectorPosition.y/=r,t.vectorPosition.z/=r,t.vectorPosition.x*=e,t.vectorPosition.y*=e,t.vectorPosition.z*=e}function s(t,e,n,i,o){var r={};return r.element=document.createElementNS(E,"text"),r.element.setAttribute("x",0),r.element.setAttribute("y",0),r.element.setAttribute("fill",p.fontColor),r.element.setAttribute("font-family",p.fontFamily),r.element.setAttribute("font-size",p.fontSize),r.element.setAttribute("font-weight",p.fontWeight),r.element.setAttribute("font-style",p.fontStyle),r.element.setAttribute("font-stretch",p.fontStretch),r.element.setAttribute("text-anchor","middle"),r.element.textContent=p.fontToUpperCase?e.label.toUpperCase():e.label,r.link=document.createElementNS(E,"a"),r.link.setAttributeNS("http://www.w3.org/1999/xlink","xlink:href",e.url),r.link.setAttribute("target",e.target),r.link.addEventListener("mouseover",f,!0),r.link.addEventListener("mouseout",h,!0),r.link.appendChild(r.element),r.index=t,r.mouseOver=!1,r.vectorPosition={x:n,y:i,z:o},r.vector2D={x:0,y:0},A.appendChild(r.link),r}function a(){for(var t=1,e=p.entries.length+1;e>t;t++){var n=Math.acos(-1+(2*t-1)/e),i=Math.sqrt(e*Math.PI)*n,o=Math.cos(i)*Math.sin(n),r=Math.sin(i)*Math.sin(n),a=Math.cos(n),u=s(t-1,p.entries[t-1],o,r,a);S.push(u)}}function u(t){for(var e=0,n=S.length;n>e;e++){var i=S[e];if(i.element.getAttribute("x")===t.getAttribute("x")&&i.element.getAttribute("y")===t.getAttribute("y"))return i}}function c(t){for(var e=u(t),n=0,i=S.length;i>n;n++){var o=S[n];o.index===e.index?o.mouseOver=!0:o.mouseOver=!1}}function l(){var t=O.x*z.x-p.speed,e=p.speed-O.y*z.y,n=t*k,i=e*k;D.sx=Math.sin(n),D.cx=Math.cos(n),D.sy=Math.sin(i),D.cy=Math.cos(i);for(var o=0,r=S.length;r>o;o++){var s=S[o];if(M){var a=s.vectorPosition.x,u=s.vectorPosition.y*D.sy+s.vectorPosition.z*D.cy;s.vectorPosition.x=a*D.cx+u*D.sx,s.vectorPosition.y=s.vectorPosition.y*D.cy+s.vectorPosition.z*-D.sy,s.vectorPosition.z=a*-D.sx+u*D.cx}var c=p.fov/(p.fov+s.vectorPosition.z);s.vector2D.x=s.vectorPosition.x*c+b.x,s.vector2D.y=s.vectorPosition.y*c+b.y,s.element.setAttribute("x",s.vector2D.x),s.element.setAttribute("y",s.vector2D.y);var l;M?(l=(x-s.vectorPosition.z)/w,l<p.opacityOut&&(l=p.opacityOut)):(l=parseFloat(s.element.getAttribute("opacity")),l+=s.mouseOver?(p.opacityOver-l)/p.opacitySpeed:(p.opacityOut-l)/p.opacitySpeed),s.element.setAttribute("opacity",l)}S=S.sort(function(t,e){return e.vectorPosition.z-t.vectorPosition.z})}function d(){requestAnimFrame(d),l()}function f(t){M=!1,c(t.target)}function h(t){M=!0}function v(t){z=m(A,t)}function m(t,e){var n=t.getBoundingClientRect();return{x:e.clientX-n.left,y:e.clientY-n.top}}function y(t){i()}var p={entries:[],width:480,height:480,radius:"70%",radiusMin:75,bgDraw:!0,bgColor:"#000",opacityOver:1,opacityOut:.05,opacitySpeed:6,fov:800,speed:2,fontFamily:"Arial, sans-serif",fontSize:"15",fontColor:"#fff",fontWeight:"normal",fontStyle:"normal",fontStretch:"normal",fontToUpperCase:!1};if(void 0!==e)for(var g in e)e.hasOwnProperty(g)&&p.hasOwnProperty(g)&&(p[g]=e[g]);if(!p.entries.length)return!1;var x,w,b,A,P,S=[],M=!0,z={x:0,y:0},C={x:0,y:0,z:0},O={x:0,y:0},D={sx:0,cx:0,sy:0,cy:0},k=Math.PI/180,E="http://www.w3.org/2000/svg";window.requestAnimFrame=function(){return window.requestAnimationFrame||window.webkitRequestAnimationFrame||window.mozRequestAnimationFrame||function(t){window.setTimeout(t,1e3/60)}}(),n()}window.SVG3DTagCloud=t}(),"undefined"!=typeof jQuery&&!function(t){t.fn.svg3DTagCloud=function(e){return this.each(function(){t.data(this,"plugin_SVG3DTagCloud")||t.data(this,"plugin_SVG3DTagCloud",new SVG3DTagCloud(this,e))})}}(jQuery);
jQuery(document).ready(function($) {
    var entries = [
        { label: 'HTML' },
        { label: 'CSS' },
        { label: 'Git' },
        { label: 'GitHub' },
        { label: 'Laravel' },
        { label: 'PHP' },
        { label: 'JavaScript' },
        { label: 'JQuery' },
        { label: 'Blade' },
        { label: 'Docker' },
        { label: 'MySql' },
        { label: 'AzureDevOps' },
        { label: 'Miro' },
        { label: 'Scrum' },
        { label: 'MDBostrap' },
        { label: 'Admin LTE' },
        { label: 'JeetStream' },
        { label: 'Sirenas'}
    ];

    var settings = {
        entries: entries,
        width: 800,
        height: 700,
        radius: '65%',
        radiusMin: 75,
        bgDraw: true,
        bgColor: 'transparent',
        opacityOver: 1.00,
        opacityOut: 0.05,
        opacitySpeed: 6,
        fov: 800,
        speed: 0.35,
        fontFamily: 'Work Sans, sans-serif',
        fontSize: '18',
        fontColor: '#fff',
        fontWeight: 'bold',
        fontStyle: 'normal',
        fontStretch: 'normal',
        fontToUpperCase: false
    };

    jQuery("#tag").svg3DTagCloud(settings);

    $("#tag").on("click", "a", function(e) {
        e.preventDefault();
    });
});

window.addEventListener('load', function() {
    const contenedor = document.getElementById('t-cont');
    const divAClonar = document.createElement('a');
    divAClonar.classList.add('luces-verdes');
    divAClonar.href = '#';

    const numLuces = 50;
    const maxDesplazamiento = 40;

    function crearLuces() {
        for (let i = 0; i < numLuces; i++) {
            const divClonado = divAClonar.cloneNode(true);
            contenedor.appendChild(divClonado);
        }
    }

    function moverLuces() {
        const luces = contenedor.getElementsByClassName('luces-verdes');

        for (let i = 0; i < luces.length; i++) {
            const luz = luces[i];
            const x = luz.dataset.x || 0;
            const y = luz.dataset.y || 0;

            const desplazamientoX = Math.random() * maxDesplazamiento * 2 - maxDesplazamiento;
            let desplazamientoY = Math.random() * maxDesplazamiento * 2 - maxDesplazamiento;

            const nuevaY = parseInt(y, 10) + desplazamientoY;
            if (nuevaY < 0) {
                desplazamientoY = -y; 
            } else if (nuevaY > window.innerHeight) {
                desplazamientoY = window.innerHeight - y;
            }

            const nuevaX = parseInt(x, 10) + desplazamientoX;

            luz.style.transition = `transform ${500}ms ease-in-out`;
            luz.style.transform = `translate(${nuevaX}px, ${nuevaY}px)`;

            luz.dataset.x = nuevaX;
            luz.dataset.y = nuevaY;
        }

        requestAnimationFrame(moverLuces);
    }

    crearLuces();
    moverLuces();
});
