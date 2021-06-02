<div id="FireInstruction" class="tab-content tab-content_overflow">
            <div class="popup__wrapper">
                <div class="cl-btn-7" onclick="close_popups()"></div>
                <h2>Инструкция о мерах пожарной безопасности на избирательном участке</h2>
                <a href="{{route('download_fire_safety_instruction',['id'=>$voting->id])}}">Скачать файл</a>
                <form id="UpdateFireInstruction" action="{{route('create_fire_safety_instruction',['id'=>$voting->id])}}" method="post">
                    @csrf
                    <div class="fields">
                        <label for="">Ответственный за обеспечение мер пожарной безопасности в помещениях УИК, помещении для голосования:</label>
                        <input type="text" name="man_fire_safety" placeholder="Фамилия Имя Отчество" list="WorkersDatalist" autocomplete="no"
                            @if($fire_safety_instruction != null)
                            value="{{$fire_safety_instruction->man_fire_safety}}"
                            @endif
                        >
                    </div>
                    <div class="fields">
                        <label for="">Допустимое (предельное) количество людей, которые могут одновременно находиться на избирательном участке:</label>
                        <input type="number" name="allowed_number" style="max-width:200px;"
                            @if($fire_safety_instruction != null)
                            value="{{$fire_safety_instruction->allowed_number}}"
                            @endif
                        >
                    </div>
                    <div class="fields">
                        <label for="">Ответственным за противопожарную безопасность в помещениях участковой избирательной комиссии и помещении для голосования назначается:</label>
                        <input type="text" name="man_fire_safety2" placeholder="Фамилия Имя Отчество" list="WorkersDatalist" autocomplete="no"
                            @if($fire_safety_instruction != null)
                            value="{{$fire_safety_instruction->man_fire_safety2}}"
                            @endif
                        >
                    </div>
                    <div class="fields">
                        <label for="">Ответственный за сообщение о возникновении пожара в пожарную охрану и оповещение (информирование) руководства и дежурных служб объекта:</label>
                        <input type="text" name="man_message_fire" placeholder="Фамилия Имя Отчество" list="WorkersDatalist" autocomplete="no"
                            @if($fire_safety_instruction != null)
                            value="{{$fire_safety_instruction->man_message_fire}}"
                            @endif
                        >
                    </div>
                    <div class="fields">
                        <label for="">Адрес объекта:</label>
                        <input type="text" name="address_object"
                            @if($fire_safety_instruction != null)
                            value="{{$fire_safety_instruction->address_object}}"
                            @endif
                        >
                    </div>
                    <div class="fields">
                        <label for="">Ответственный за организацию эвакуации и спасение людей с использованием для этого имеющихся сил и средств, в том числе за оказание первой помощи пострадавшим:</label>
                        <input type="text" name="man_evacuation" placeholder="Фамилия Имя Отчество" list="WorkersDatalist" autocomplete="no"
                            @if($fire_safety_instruction != null)
                            value="{{$fire_safety_instruction->man_evacuation}}"
                            @endif
                        >
                    </div>
                    <div class="fields">
                        <label for="">Ответственный за проверку включения автоматических систем противопожарной защиты (систем оповещения людей о пожаре, пожаротушения, противодымной защиты):</label>
                        <input type="text" name="man_fire_protection_check" placeholder="Фамилия Имя Отчество" list="WorkersDatalist" autocomplete="no"
                            @if($fire_safety_instruction != null)
                            value="{{$fire_safety_instruction->man_fire_protection_check}}"
                            @endif
                        >
                    </div>
                    <div class="fields">
                        <label for="">Ответственный за отключение при необходимости электроэнергии (за исключением систем противопожарной защиты), остановку работы систем вентиляции в аварийном и смежных с ним помещениях, выполнение других мероприятий, способствующих предотвращению развития пожара и задымления помещений здания:</label>
                        <input type="text" name="man_power_outage" placeholder="Фамилия Имя Отчество" list="WorkersDatalist" autocomplete="no"
                            @if($fire_safety_instruction != null)
                            value="{{$fire_safety_instruction->man_power_outage}}"
                            @endif
                        >
                    </div>
                    <div class="fields">
                        <label for="">При необходимости отключения электроснабжения здания для обеспечения безопасности проведения работ по тушению пожара, отключение электроэнергии производится в:</label>
                        <input type="text" name="place_power_outage"
                            @if($fire_safety_instruction != null)
                            value="{{$fire_safety_instruction->place_power_outage}}"
                            @endif
                        >
                    </div>
                    <div class="fields">
                        <label for="">Ответственный за прекращение всех работ в здании, кроме работ, связанных с мероприятиями по ликвидации пожара:</label>
                        <input type="text" name="man_work_stoppage" placeholder="Фамилия Имя Отчество" list="WorkersDatalist" autocomplete="no"
                            @if($fire_safety_instruction != null)
                            value="{{$fire_safety_instruction->man_work_stoppage}}"
                            @endif
                        >
                    </div>
                    <div class="fields">
                        <label for="">Ответственный за осуществление общего руководства по тушению пожара до прибытия подразделения пожарной охраны:</label>
                        <input type="text" name="man_guide" placeholder="Фамилия Имя Отчество" list="WorkersDatalist" autocomplete="no"
                            @if($fire_safety_instruction != null)
                            value="{{$fire_safety_instruction->man_guide}}"
                            @endif
                        >
                    </div>
                    <div class="fields">
                        <label for="">Ответственный за организацию эвакуации и защиты документов, в том числе избирательных бюллетеней и материальных ценностей:</label>
                        <input type="text" name="man_evacuation2" placeholder="Фамилия Имя Отчество" list="WorkersDatalist" autocomplete="no"
                            @if($fire_safety_instruction != null)
                            value="{{$fire_safety_instruction->man_evacuation2}}"
                            @endif
                        >
                    </div>
                    <div class="fields">
                        <label for="">Ответственный за встречу подразделений пожарной охраны и оказание помощи в выборе кратчайшего пути для подъезда к очагу пожара:</label>
                        <input type="text" name="man_meeting" placeholder="Фамилия Имя Отчество" list="WorkersDatalist" autocomplete="no"
                            @if($fire_safety_instruction != null)
                            value="{{$fire_safety_instruction->man_meeting}}"
                            @endif
                        >
                    </div>
                    <div class="fields">
                        <label for="">По прибытии пожарного подразделения информирование руководителя тушения пожара о конструктивных и технологических особенностях объекта, прилегающих строений и сооружений, о количестве и пожароопасных свойствах хранимых и применяемых на объекте веществ, материалов, изделий и сообщение других сведений, необходимых для успешной ликвидации пожара:</label>
                        <input type="text" name="man_guide2" placeholder="Фамилия Имя Отчество" list="WorkersDatalist" autocomplete="no"
                            @if($fire_safety_instruction != null)
                            value="{{$fire_safety_instruction->man_guide2}}"
                            @endif
                        >
                    </div>
                    <div class="block-btn">
                        <button class="btn-submit" type="submit" form="UpdateFireInstruction" class="btn">
                            Сохранить
                        </button>
                    </div>
                </form>
            </div>
        </div>