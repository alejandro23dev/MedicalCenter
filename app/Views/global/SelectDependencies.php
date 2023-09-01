<script>
    //FUNCIÓN DE DEPENDENCIA DE LOS SELECTS DE UBICACIÓN

    var selectPaís = $("#country");
    var selectProvincia = $("#province");
    var selectMunicipio = $("#municipality");
    var selectDistribution = $("#distribution");

   
    // Definir las Provincias por País
    var provinciaPorPaís = {
      'Cuba': ["La Habana", "Pínar del Río", "Mayabeque"],
    };

    // Definir los municipios por provincia
    var municipiosPorProvincia = {
      'La Habana': ["Plaza de la Revolución", "Habana Vieja", "Centro Habana", "Diez de Octubre", "Cerro", "Arroyo Naranjo", "Boyeros", "Playa", "Marianao", "La Lisa", "Guanabacoa", "Regla", "Habana del Este", "San Miguel del Padrón", "Cotorro"],
    };

    // Definir las distribuciones por municipio
    var distribucionesPorMunicipio = {
      'Cotorro': ["Santa Amelia", "La Portada", "Cuatro Caminos"],
      'Boyeros': ["Alta Habana", "Santiago de las Vegas"],
      'Guanabacoa': ["DistribuciónX", "DistribuciónY", "DistribuciónZ"],
      // Agrega más distribuciones según tus necesidades
    };

    // Escuchar el evento de cambio en el select del país
    selectPaís.on("change", function() {
      // Obtener el valor seleccionado del país
      var paísSeleccionado = $(this).val();

      // Obtener las provincias correspondientes al país seleccionado
      var provincias = provinciaPorPaís[paísSeleccionado];

      // Vaciar el select de provincias y municipios
      selectProvincia.empty();
      selectMunicipio.empty();
      selectDistribution.empty();

      // Agregar las provincias correspondientes al select de provincias
      $.each(provincias, function(index, provincia) {
        if (provincia == "<?php echo @$provinceClient; ?>" || provincia =="<?php echo @$updateUserProvince ?>") //La variable distributionMunicipality se instancia en el controlador que muestra esta vista
        selectProvincia.append(new Option(provincia, provincia, true, true)); //TRUE, TRUE Significa Select
        else
        selectProvincia.append(new Option(provincia, provincia));
      });

      // Disparar el evento de cambio en el select de provincias
      selectProvincia.trigger("change");
    });

    // Escuchar el evento de cambio en el select de la provincia
    selectProvincia.on("change", function() {
      // Obtener el valor seleccionado de la provincia
      var provinciaSeleccionada = $(this).val();

      // Obtener los municipios correspondientes a la provincia seleccionada
      var municipios = municipiosPorProvincia[provinciaSeleccionada];

      // Vaciar el select de municipios y distribuciones
      selectMunicipio.empty();
      selectDistribution.empty();

      // Agregar los municipios correspondientes al select de municipios
      $.each(municipios, function(index, municipio) {
        if (municipio == "<?php echo @$municipalityClient; ?>" || municipio == "<?php echo @$updateUserMunicipality ?>") //La variable distributionMunicipality se instancia en el controlador que muestra esta vista
        selectMunicipio.append(new Option(municipio, municipio, true, true)); //TRUE, TRUE Significa Select
        else
        selectMunicipio.append(new Option(municipio, municipio));
      });

      // Disparar el evento de cambio en el select de municipios
      selectMunicipio.trigger("change");
    });

    // Escuchar el evento de cambio en el select del municipio
    selectMunicipio.on("change", function() {
      // Obtener el valor seleccionado del municipio
      var municipioSeleccionado = $(this).val();

      // Obtener las distribuciones correspondientes al municipio seleccionado
      var distribuciones = distribucionesPorMunicipio[municipioSeleccionado];

      // Vaciar el select de distribuciones
      selectDistribution.empty();

      // Agregar las distribuciones correspondientes al select de distribuciones
      $.each(distribuciones, function(index, distribucion) {
        if (distribucion == "<?php echo @$distributionClient; ?>" || distribucion == "<?php echo @$updateUserDistribution ?>") //La variable distributionClient se instancia en el controlador que muestra esta vista
        selectDistribution.append(new Option(distribucion, distribucion, true, true)); //TRUE, TRUE Significa Select
        else
        selectDistribution.append(new Option(distribucion, distribucion));
      });
    });

    // Disparar el evento de cambio en el select del país para iniciar la cascada de cambios
    selectPaís.trigger("change");

</script>