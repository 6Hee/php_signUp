//오로지 검색용만으로 사용


$(document).ready(function(){


    //키보드 이벤트 : 입력상자에서 이벤트가 발생한 곳 (상위 부모를 대상으로 선정하여도 된다.)
    $("#search").keydown(function(e){
        console.log(e);
        if(e.keyCode == 13){
            if($("#search input").val().length < 1){
                //작동 x
                alert("검색어를 입력하세요.");
            }else{
                $("#search form").submit();
            }
        }
    });

    //클릭이벤트 : "검색"이라는 버튼을 클릭했을 때 이벤트 발생
    $("#search button").click(function(){
        if($("#search input").val().length < 1){
            //작동 x
            alert("검색어를 입력하세요.");
        }else{
            $("#search form").submit();
        }
    });



    //sort 버튼 활성화
    var $url = window.location.href;
    console.log($url); //http://localhost/oclass/products_list.php?sort=newSort
    //http://localhost/oclass/products_list.php?sort=newSort
    //http://localhost/oclass/products_search_list.php?sort=lowSort&word=%EB%A7%88%EC%B9%B4%EB%A1%B1

    var $specified_str_index = $url.indexOf("?");
    console.log($specified_str_index);  //-1은 '?'라는 지정된 문자가 $url에는 존재하지 않는다. 0 ~ 양의 정수는 지정된 문자가 $url에는 존재한다.


    if($specified_str_index >= 0){
        
        var $url_after = $url.split("?");
        console.log($url_after); //['http://localhost/oclass/products_list.php', 'sort=newSort']

        if($url_after[1].indexOf("&") == -1){ //products_list.php에서 sort 버튼을 클릭시

            var $url_sortVal = $url_after[1].split("=");
            console.log($url_sortVal); //['sort', 'newSort']  => $url_sortVal[1] = 정렬이 진행된 형식
        }else{ //products_search_list.php에서 sort 버튼 클릭시
            var $url_obj_first = $url_after[1].split("&");  //중간에 위치한  '&'버튼을 기준으로 배열 분리
            console.log($url_obj_first);  //['sort=lowSort', 'word=마카롱']
            var $url_sortVal = $url_obj_first[0].split("=");
            console.log($url_sortVal);  //['sort', 'lowSort']

        }
        

        $("#sort_btn button").removeClass("active");
        $("#sort_btn button."+ $url_sortVal[1]).addClass("active");
    }




});