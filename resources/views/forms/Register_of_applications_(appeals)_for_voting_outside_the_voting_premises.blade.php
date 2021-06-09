<div id="Register_of_applications_appeals_for_voting_outside_the_voting_premises" class="tab-content tab-content_overflow">
    <div class="popup__wrapper">
        <div class="cl-btn-7" onclick="close_popups()"></div>
        <h2>РЕЕСТР заявлений (обращений) о голосовании вне помещения для голосования</h2>
        <a href="{{route('download_register_applications_appeals_for_voting',['id'=>$voting->id])}}">Скачать файл</a>
        <form id="Update_Register_of_applications_appeals_for_voting_outside_the_voting_premises" class="form_overflow" action="{{route('create_register_applications_appeals_for_voting',['id'=>$voting->id])}}" method="post">
            @csrf
            <div>
                <table style="width:100%;">
                    <thead>
                    <tr>
                        <td>Фамилия, имя, отчество избира-теля</td>
                        <td>Адрес места жительства</td>
                        <td>Причина вызова комиссии на дом</td>
                        <td>Дата и время приема устного обращения</td>
                        <td>Дата и время приема письменного заявления</td>
                        <td>Фамилия, имя, отчество передавшего заявление или устное обращение</td>
                        <td>Адрес места жительства лица передавшего заявление или устное обращение</td>
                        <td>Фамилия, имя, отчество члена УИК, принявшего заявление или устное обращение</td>
                        <td>Удалить строку</td>
                    </tr>
                    </thead>
                    <tbody id="Register_of_applications_appeals_for_voting_outside_the_voting_premises_table">
                    @if(isset($register_applications_appeals_for_votings))
                        @foreach($register_applications_appeals_for_votings as $log)
                            <tr class="Register_of_applications_appeals_for_voting_outside_the_voting_premises_inputs">
                                <td><input type="text" name="voter_name[]" placeholder="Фамилия Имя Отчество" value="{{$log->voter_name}}"></td>
                                <td><input type="text" name="voter_address[]" value="{{$log->voter_address}}"></td>
                                <td><input type="text" name="reason_calling_commission[]" value="{{$log->reason_calling_commission}}"></td>
                                <td><input type="datetime-local" name="datetime_oral_appeal[]" value="{{date('Y-m-d\TH:i', strtotime($log->datetime_oral_appeal))}}"></td>
                                <td><input type="datetime-local" name="datetime_written_appeal[]" value="{{date('Y-m-d\TH:i', strtotime($log->datetime_written_appeal))}}"></td>
                                <td><input type="text" name="name_transmitting_appeal[]" placeholder="Фамилия Имя Отчество" value="{{$log->name_transmitting_appeal}}"></td>
                                <td><input type="text" name="address_transmitting_appeal[]" value="{{$log->address_transmitting_appeal}}"></td>
                                <td><input type="text" name="name_accepted_appeal[]" placeholder="Фамилия Имя Отчество" list="WorkersDatalist" value="{{$log->name_accepted_appeal}}"></td>
                                <td>
                                    <button class="btn-danger-table" type="button" onclick="$(this).closest('.Register_of_applications_appeals_for_voting_outside_the_voting_premises_inputs').remove();">Удалить строку</button>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
                <div class="block-btn">
                    <button id="Create_Register_of_applications_appeals_for_voting_outside_the_voting_premises_Btn" class="btn-blue" type="button">Создать ячейки</button>
                    <button id="Delete_Register_of_applications_appeals_for_voting_outside_the_voting_premises_Btn" class="btn-danger" type="button">Удалить ячейки</button>
                </div>
            </div>
            <div class="block-btn">
                <button class="btn-submit" type="submit" form="Update_Register_of_applications_appeals_for_voting_outside_the_voting_premises" class="btn">
                    Сохранить
                </button>
            </div>
        </form>
    </div>
</div>
