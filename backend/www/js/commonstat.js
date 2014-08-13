var NSCH = {};
    $(function(){
       NSCH.enabledFilters = {
           'p1':true,
           'p2':false,
           'p3':true,
           'p4':true,
           'mt1':true,
           'mt2':false,
           'mt3':true,
           'mt4':false,
           'ch1':false,
           'ch2':true,
           'v1':false,
           'v2':false,
           'v3':false,
           'v4':true
       };
       NSCH.Common = $('.commonstat div div ul li');
       NSCH.Common.click(commonViewer);
       $('.commonstat div').find('input[name="send"]').click(filteredView);
       NSCH.GraphicalBlock = $('.dataGraph');
    });
    function commonViewer(){
        var enid = this.id;
        NSCH.Common.each(function(){
            if(NSCH.enabledFilters[enid] === false){
                NSCH.Common.parent().parent().parent().find('.intervalls').css('display','none');
            }else{
                NSCH.Common.parent().parent().parent().find('.intervalls').css('display','block');
            }
            if(enid === this.id){
                $(this).addClass('selectRed');
            }else{
                $(this).removeClass('selectRed');
            }
        });
        NSCH.currElemId = this.id;
        var targetInd = $(this).parent().parent().parent().index();
        NSCH.GraphicalBlock.each(function(index){
            $(this).find('.graph').empty();
           if(index === targetInd){
               $(this).css('display', 'block');
               createGraphics({'Item':NSCH.currElemId}, $(this).find('.graph'));
           }else{
               $(this).css('display', 'none');
           }
        });        
    }
    function filteredView(){
        var begin = $(this).parent().find('input[name=begin]').val();
        var step = $(this).parent().find('select[name=step]').val();
        var end = $(this).parent().find('input[name=end]').val();
        createGraphics(
                {'Item':NSCH.currElemId,
                'begin':begin,
                'step':step,
               'end':end},
        $(this).parent().parent().parent().find('.graph'));
    }
