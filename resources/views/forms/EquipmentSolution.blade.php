<div id="EquipmentSolution" class="tab-content tab-content_overflow">
            <div class="popup__wrapper">
                <div class="cl-btn-7" onclick="close_popups()"></div>
                <h2>Решение о схеме размещения оборудования</h2>
                <a href="{{route('download_solution_equipment_diagram',['id'=>$voting->id])}}">Скачать файл</a>
                <form id="UpdateEquipmentSolution" action="{{route('create_solution_equipment_diagram',['id'=>$voting->id])}}" method="post">
                    @csrf
                    <p> О схеме размещения технологического и иного оборудования 
                        , мест, отведенных для работы членов участковой </br>
                        избирательной комиссии, наблюдателей и иных лиц, в соответствии 
                        с постановлением Центральной избирательной комиссии Российской Федерации от</br>
                        <input type="text" name="data" placeholder="20 марта 2020 года № 244/1804-7 «О Порядке общероссийского голосования по вопросу одобрения изменений в Конституцию Российской Федерации» (в редакции постановления Центральной избирательной комиссии Российской Федерации от 2 июня 2020 года 250/1840-7)"
                               @if(isset($solution_equipment_diagram->data))
                               value="{{$solution_equipment_diagram->data}}"
                            @endif
                        ></br>
                        , в период досрочного голосования в помещении участковой избирательной комиссии...
                    </p>
                    <div class="block-btn">
                        <button class="btn-submit" type="submit" form="UpdateEquipmentSolution" class="btn">
                            Сохранить
                        </button>
                    </div>
                </form>
            </div>
        </div>