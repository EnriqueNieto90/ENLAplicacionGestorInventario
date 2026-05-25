{{-- Isotipo: caja de embalaje con cinta. Color y tamaño se controlan
     desde fuera vía la clase pasada al componente (stroke + w/h). --}}
<svg {{ $attributes }} viewBox="0 0 48 48" fill="none"
     stroke="currentColor" stroke-width="2.4"
     stroke-linecap="round" stroke-linejoin="round"
     xmlns="http://www.w3.org/2000/svg">
    
    {{-- Silueta exterior de la caja y líneas interiores (Y) --}}
    <path d="M24 4 L42 13 L42 35 L24 44 L6 35 L6 13 Z"/>
    <path d="M6 13 L24 22 L42 13"/>
    <path d="M24 22 L24 44"/>
    
    {{-- Cinta de embalaje cruzando el centro de la tapa y bajando por el lateral --}}
    <path d="M33 8.5 L15 17.5 L15 31" 
          stroke-width="4.8" 
          stroke-linecap="butt"/>
</svg>
