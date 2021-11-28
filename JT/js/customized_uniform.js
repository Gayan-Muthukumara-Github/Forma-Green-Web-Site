function text_box_show()
  {
    var select_status = $('#messagetype').val();

    if(select_status == 'Pre school frock')
    {
        $('#Pre_school_frock').show();

    }
    else
    {
        
        $('#Pre_school_frock').hide();

    }
    if(select_status == 'School frock')
    {
        $('#School_frock').show();

    }
    else
    {
        
        $('#School_frock').hide();

    }
    if(select_status == 'Skirt')
    {
        $('#Skirt').show();

    }
    else
    {
        
        $('#Skirt').hide();

    }
    if(select_status == 'Shirt')
    {
        $('#Shirt').show();

    }
    else
    {
        
        $('#Shirt').hide();

    }
    if(select_status == 'Short')
    {
        $('#Short').show();

    }
    else
    {
        
        $('#Short').hide();

    }
    if(select_status == 'Trouser')
    {
        $('#Trouser').show();

    }
    else
    {
        
        $('#Trouser').hide();

    }
  }