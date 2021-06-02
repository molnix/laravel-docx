<div id="List_oznakomleniya_c_pravilami_pojarnoi_bezopacnocti" class="tab-content tab-content_overflow">
            <div class="popup__wrapper">
                <div class="cl-btn-7" onclick="close_popups()"></div>
                <h2>Лист ознакомления с правилами пожарной безопасности</h2>
                <a href="{{route('download_fire_safety_information_sheet',['id'=>$voting->id])}}">Скачать файл</a>
                <form id="UpdateList_oznakomleniya_c_pravilami_pojarnoi_bezopacnocti" class="form_overflow" action="{{route('create_fire_safety_information_sheet',['id'=>$voting->id])}}" method="post">
                    @csrf
                    <div>
                        <table style="width:100%;">
                            <thead>
                            <tr>
                                <td>Фамилия, имя, отчество</td>
                                <td>Удалить строку</td>
                            </tr>
                            </thead>
                            <tbody id="List_oznakomleniya_c_pravilami_pojarnoi_bezopacnocti_Table">
                            @if(isset($fire_safety_information_sheet_logs))
                                @foreach($fire_safety_information_sheet_logs as $log)
                                    <tr class="List_oznakomleniya_c_pravilami_pojarnoi_bezopacnocti_inputs">
                                        <td>
                                            <input type="text" name="name[]" value="{{$log->name}}" placeholder="Фамилия Имя Отчество" list="WorkersDatalist" autocomplete="no">
                                        </td>
                                        <td>
                                            <button class="btn-danger-table" type="button" onclick="$(this).closest('.List_oznakomleniya_c_pravilami_pojarnoi_bezopacnocti_inputs').remove();">Удалить строку</button>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                        <div class="block-btn">
                            <button id="CreateList_oznakomleniya_c_pravilami_pojarnoi_bezopacnocti_Btn" class="btn-blue" type="button">Создать ячейки</button>
                            <button id="DeleteList_oznakomleniya_c_pravilami_pojarnoi_bezopacnocti_Btn" class="btn-danger" type="button">Удалить ячейки</button>
                        </div>
                    </div>
                    <div class="block-btn">
                        <button class="btn-submit" type="submit" form="UpdateList_oznakomleniya_c_pravilami_pojarnoi_bezopacnocti" class="btn">
                            Сохранить
                        </button>
                    </div>
                </form>
            </div>
        </div>