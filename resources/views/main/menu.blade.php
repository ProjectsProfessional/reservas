<div class="sidebar-sticky content">
   <ul class="nav flex-column">
      <li class="nav-item">
         <a class="nav-link active"  data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
         <span data-feather="home"></span>
         Gestión <span class="sr-only">(current)</span>
         </a>
         <ul class = "nav-tabs navbar-collapse">
            <li id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
               <a class="nav-link" href="#" data-toggle="collapse"  data-target="#collapseDefiniciones" aria-expanded="false" aria-controls="collapseDefiniciones">
               <span data-feather="folder-plus"></span>
               Definiciones
               </a>
               <div id="collapseDefiniciones" class="collapse" data-parent="#accordion">
                  <ul>
                     <li>
                        <a class="nav-link" href="#" data-toggle="collapse"  data-target="#collapseGeneral" aria-expanded="false" aria-controls="collapseGeneral">
                        <span data-feather="chevron-down"></span>
                        General
                        </a>
                     </li>
                     <div id="collapseGeneral" class="collapse" data-parent="#accordion">
                        <ul>
                           <li>
                              <a class="nav-link" href="{{route('users')}}">
                                 <span data-feather="users"></span>
                                 usuarios
                              </a>
                           </li>

                           <li>
                              <a class="nav-link" href="{{route('currencies')}}">
                              <span data-feather="dollar-sign"></span>
                              Monedas
                              </a>
                           </li>
                           <li>
                              <a class="nav-link" href="{{route('clients')}}">
                              <span data-feather="users"></span>
                              Clientes
                              </a>
                           </li>
                           <li>
                              <a class="nav-link" href="{{route('impuestos')}}">
                              <span data-feather="square"></span>
                              Impuesto
                              </a>
                           </li>
                        </ul>
                     </div>
				 <!-- Habitaciones-->
				 <li>
                        <a class="nav-link" href="#" data-toggle="collapse"  data-target="#collapseHab" aria-expanded="false" aria-controls="collapseHab">
                        <span data-feather="chevron-down"></span>
                        Habitaciones
                        </a>
                     </li>
                     <div id="collapseHab" class="collapse" data-parent="#accordion">
                        <ul>
                           <li>
                              <a class="nav-link" href="{{route('tiposHabitaciones')}}">
                              <span data-feather="square"></span>
                              Tipo de habitación
                              </a>
                           </li>
                           <li>
                              <a class="nav-link" href="{{route('habitaciones')}}">
                              <span data-feather="square"></span>
                              Imagenes de habitaciones
                              </a>
                           </li>
                        </ul>
                     </div>
				 <!-- Reservas-->
				 <li>
                        <a class="nav-link" href="#" data-toggle="collapse"  data-target="#collapseRes" aria-expanded="false" aria-controls="collapseRes">
                         <span data-feather="chevron-down"></span>
                        Reservas
                        </a>
                     </li>
                     <div id="collapseRes" class="collapse" data-parent="#accordion">
                        <ul>
                           <li>
                              <a class="nav-link" href="{{route('fuentes')}}">
                              <span data-feather="cloud"></span>
                              Fuentes de reservación
                              </a>
                           </li>
                        </ul>
                     </div>
				 <!--Precios-->
                     <li>
                        <a class="nav-link" href="#" data-toggle="collapse"  data-target=".multi-collapse" aria-expanded="false" aria-controls="collapseR1 collapseR2">
                         <span data-feather="chevron-down"></span>
                        Precios
                        </a>
                        <ul>
                           <li class="collapse multi-collapse" id="collapseR2" data-parent="#accordion">
                              <a class="nav-link" href="{{route('precio')}}">
                              <span data-feather="dollar-sign"></span>
                              Determinación de precios
                              </a>
                           </li>
                        </ul>
                     </li>
                  </ul>
               </div>
            </li>
         </ul>
      </li>
      <li class="nav-item" data-toggle="collapse"  data-target="#collapseSocios" aria-expanded="false" aria-controls="collapseSocios">
         <a class="nav-link" href="#">
         <span data-feather="calendar"></span>
         Reservas
         </a>
         <ul class = "nav-tabs navbar-collapse" >
            <li id="collapseSocios" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
               <a class="nav-link" href="{{route('reservas')}}">
               <span data-feather="calendar"></span>
               Reservas
               </a>
            </li>
         </ul>
      </li>
	 <li class="nav-item" data-toggle="collapse" data-target="#collapseHabitaciones" aria-expanded="false" aria-controls="collapseHabitaciones">
	    <a class="nav-link" href="#">
	    <span data-feather="calendar"></span>
	   Habitaciones
	    </a>

		    <ul class = "nav-tabs navbar-collapse" >
			     <div id="collapseHabitaciones" class="collapse" data-parent="#accordion">
		     		  <li >
		     			<a class="nav-link" href="{{route('nuevasHabitaciones')}}">
		     			<span data-feather="calendar"></span>
		     			Habitaciones
		     			</a>
		     		  </li>
		     		  <li >
		     		     <a class="nav-link" href="{{route('estados')}}">
		     		     <span data-feather="calendar"></span>
		     		     Estado habitaciones
		     		     </a>
		     		  </li>
			   </div>
     	    </ul>

	 </li>
      <li class="nav-item" data-toggle="collapse" data-target="#collapseReportes" aria-expanded="false" aria-controls="collapseReportes">
         <a class="nav-link" href="#">
         <span data-feather="bar-chart-2"></span>
         Reportes
         </a>
         <ul class = "nav-tabs navbar-collapse" >
            <div  id="collapseReportes" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
               <li class="nav-item">
                  <a class="nav-link" href="{{route('reports.daily')}}">
                  <span data-feather="file-text"></span>
                  Corte diario
                  </a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="{{route('reports.byDate')}}">
                  <span data-feather="file-text"></span>
                  Informe General De ofrendas
                  </a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="{{route('reports.byPartner')}}">
                  <span data-feather="file-text"></span>
                  Ofrendas por Socio
                  </a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="{{route('reports.byCurrency')}}">
                  <span data-feather="file-text"></span>
                  Importes Cargados Por Moneda
                  </a>
               </li>
            </div>
         </ul>
      </li>
      <!--
         <li class="nav-item">
             <a class="nav-link" href="#">
                 <span data-feather="layers"></span>
                 Integrations
             </a>
         </li>
         -->
   </ul>
</div>
<script type="text/javascript">
   $('.collapse').collapse()
</script>
