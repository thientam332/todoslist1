(function(){
    $('.multiple-submits').on('submit', function(){
        $('.multiple-submits-delete').attr('disabled','true');
        $('.multiple-submits-checkbox').attr('disabled','true');
        $('.multiple-submits-create').attr('disabled','true');
    })
    })();
    (function(){
    $('.multiple-submits-checkbox').on('change', function(){
        $('.multiple-submits-delete').attr('disabled','true');
        $('.multiple-submits-checkbox').attr('disabled','true');
    })
    })();