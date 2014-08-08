var NSCH = {};
    $(function(){
       NSCH.Common = $('.commonstat div div ul li');
       NSCH.Common.click(commonViewer);
       $('.commonstat div').find('input[name="send"]').click(filteredView);
       NSCH.GraphicalBlock = $('.dataGraph');
    });
    NSCH.flush = function(){NSCH.currElemId='0';}
    function commonViewer(){
        NSCH.flush();
        var enid = this.id;
        NSCH.Common.each(function(){
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
