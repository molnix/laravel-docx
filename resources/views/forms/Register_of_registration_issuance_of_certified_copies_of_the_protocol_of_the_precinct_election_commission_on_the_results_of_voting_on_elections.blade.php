<div id="Register_registration_issuance_certified_copies" class="tab-content tab-content_overflow">
    <div class="popup__wrapper">
        <div class="cl-btn-7" onclick="close_popups()"></div>
        <h2>РЕЕСТР заявлений (обращений) о голосовании вне помещения для голосования</h2>
        <a href="{{route('download_register_registration_issuance_certified_copies',['id'=>$voting->id])}}">Скачать файл</a>
        <form id="Update_Register_registration_issuance_certified_copies" class="form_overflow" action="{{route('create_register_registration_issuance_certified_copies',['id'=>$voting->id])}}" method="post">
            @csrf
            <div>
                <table style="width:100%;">
                    <thead>
                    <tr>
                        <td>№ п/п – номер заверенной копии протокола</td>
                        <td>Фамилия, имя, отчество лица, получившего копию протокола</td>
                        <td>Статус лица, получившего копию протокола</td>
                        <td>Фамилия, инициалы председателя, либо заместителя председателя либо секретаря УИК, заверившего копию протокола</td>
                        <td>Дата, время выдачи копии протокола</td>
                        <td>Контактный телефон получившего копию протокола</td>
                        <td>Удалить строку</td>
                    </tr>
                    </thead>
                    <tbody id="Register_registration_issuance_certified_copies_table">
                    @if(isset($register_registration_issuance_certified_copies))
                        @foreach($register_registration_issuance_certified_copies as $log)
                            <tr class="Register_registration_issuance_certified_copies_inputs">
                                <td><input type="text" name="number[]" value="{{$log->number}}"></td>
                                <td><input type="text" name="person_accepted_protocol[]" placeholder="Фамилия Имя Отчество" value="{{$log->person_accepted_protocol}}"></td>
                                <td><input type="text" name="person_accepted_protocol_status[]" value="{{$log->person_accepted_protocol_status}}"></td>
                                <td><input type="text" name="personal_assured_name[]" placeholder="И. О. Фамилия" list="MainWorkers" autocomplete="no" value="{{$log->personal_assured_name}}"></td>
                                <td><input type="datetime-local" name="datetime_issuing[]" value="{{date('Y-m-d\TH:i', strtotime($log->datetime_issuing))}}"></td>
                                <td><input type="text" name="telephone[]" value="{{$log->telephone}}"></td>
                                <td>
                                    <button class="btn-danger-table" type="button" onclick="$(this).closest('.Register_registration_issuance_certified_copies_inputs').remove();">Удалить строку</button>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
                <div class="block-btn">
                    <button id="Create_Register_registration_issuance_certified_copies_Btn" class="btn-blue" type="button">Создать ячейки</button>
                    <button id="Delete_Register_registration_issuance_certified_copies_Btn" class="btn-danger" type="button">Удалить ячейки</button>
                </div>
            </div>
            <div class="block-btn">
                <button class="btn-submit" type="submit" form="Update_Register_registration_issuance_certified_copies" class="btn">
                    Сохранить
                </button>
            </div>
        </form>
    </div>
</div>
