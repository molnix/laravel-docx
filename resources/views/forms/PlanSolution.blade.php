<div id="PlanSolution" class="tab-content tab-content_overflow">
            <div class="popup__wrapper">
                <div class="cl-btn-7" onclick="close_popups()"></div>
                <h2>Решение о плане работы</h2>
                <a href="{{route('download_solution_work_plan',['id'=>$voting->id])}}">Скачать файл</a>
                <form id="UpdatePlanSolution" action="{{route('create_solution_work_plan',['id'=>$voting->id])}}" method="post">
                    @csrf
                    <p> В соответствии с постановлением Центральной избирательной комиссии Российской Федерации от</br>
                        <input type="text" name="data" placeholder="20 марта 2020 года № 244/1804-7 «О Порядке общероссийского голосования по вопросу одобрения изменений в Конституцию Российской Федерации» (в редакции постановления Центральной избирательной комиссии Российской Федерации от 2 июня 2020 года 250/1840-7)"
                               @if(isset($solution_work_plan->data))
                               value="{{$solution_work_plan->data}}"
                            @endif
                        ></br>
                        , участковая избирательная комиссия решила...
                    </p>
                    <div class="block-btn">
                        <button class="btn-submit" type="submit" form="UpdatePlanSolution" class="btn">
                            Сохранить
                        </button>
                    </div>
                </form>
            </div>
        </div>