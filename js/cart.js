$(document).ready(function(){

    var $each_amount = [];  //각 수량 정보를 갖고 있음
    var $each_total = [];  //나는 처음부터 배열의 형식을 갖고 올 것이다.

    var final_total = 0;


    function price_calc(){
        $each_total = [];  //기존의 데이터들을 비우고 다시 담는다.

        //각 리스트의 총액을 배열 데이터에 넣겠다는 의미
        $(".cart_detail").each(function(index){
            var $each_pd_total = Number($(this).find(".total").attr("total"));
            console.log($each_pd_total);
            $each_total.push($each_pd_total);
            console.log($each_total);
        });

        console.log("each문 종료");

        //배열 데이터에 존재하는 각 리스트의 총액을 합산한다.
        final_total = 0;  //기존 값을 0으로 재구성 후 다시 합산시킨다.

        for(v of $each_total){
            console.log(v);
            final_total += v;
            console.log(final_total);
        }
        var final_total_format = final_total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

        $(".pay_price").attr("final-total", final_total).find("span").text(final_total_format);
        
    }
    price_calc();

    $(".minus").click(function(){
        //0이라는 숫자는 절대 나오면 안된다.
        
        var $input_val = Number($(this).siblings("input").val()); //최초 브라우저 로딩시 가져온 수량
        console.log($input_val);

        var $price = Number($(this).closest("span").siblings(".price").attr("price"));
        console.log($price);

        if($input_val < 2){
            alert("최소 예약시간은 1시간 입니다.");
        }else{
            $input_val--; //만약 수량이 7이었다면 6으로 변경
            $(this).siblings("input").val($input_val);
            $pd_total = $price * $input_val;

            $total_numberFormat = $pd_total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            console.log($total_numberFormat);

            $(this).closest("span").siblings(".total").attr("total", $pd_total).text($total_numberFormat);
        }
        price_calc();
        return false;
    });

    $(".plus").click(function(){
        var $input_val = Number($(this).siblings("input").val());  //최초 브라우저 로딩시 가져온 수량
        console.log($input_val);
        var $price = Number($(this).closest("span").siblings(".price").attr("price"));
        console.log($price);

        $input_val++;
        $(this).siblings("input").val($input_val);  
        $pd_total = $price * $input_val;  //숫자형 데이터
        
        $total_numberFormat = $pd_total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        console.log($total_numberFormat);  //문자형 데이터

        $(this).closest("span").siblings(".total").attr("total", $pd_total).text($total_numberFormat);

        price_calc();
        return false;
    });



});