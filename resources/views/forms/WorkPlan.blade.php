<div id="WorkPlan" class="tab-content tab-content_overflow">
            <div class="popup__wrapper">
                <div class="cl-btn-7" onclick="close_popups()"></div>
                <h2>План работы УИК в период проведения выборов</h2>
                <a href="{{route('download_work_plan',['id'=>$voting->id])}}">Скачать файл</a>
                <form id="UpdateWorkPlan" action="{{route('create_work_plan',['id'=>$voting->id])}}" method="post">
                    @csrf
                    <div class="fields">
                        <label for="">Проведение заседания УИК. Не позднее за:</label>
                        <input type="text" placeholder="16 июня" name="conduct_meeting_date"
                               @if($work_plan != null)
                               value="{{$work_plan->conduct_meeting_date}}"
                            @endif>
                    </div>
                    <div class="fields">
                        <p> Прием и регистрация обращений (заявлений) избирателей о намерении проголосовать вне помещения для голосования.
                            <p><label for="">Начинается с (число):</label></p>
                            <input type="text" placeholder="16 июня" name="reception_and_registration_start_date"
                                   @if($work_plan != null)
                                   value="{{$work_plan->reception_and_registration_start_date}}"
                                @endif
                            >
                            <p><label for="">Завершается в день голосования (время):</label></p>
                            <input type="text" placeholder="18.00" name="reception_and_registration_end_time"
                                   @if($work_plan != null)
                                   value="{{$work_plan->reception_and_registration_end_time}}"
                                @endif
                            >
                        </p>
                    </div>
                    <div class="fields">
                        <p> Обеспечение реализации активного избирательного права избирателями, голосующими досрочно. В период:
                            <p><label for="">С:</label></p>
                            <input type="text" placeholder="16 июня" name="active_suffrage_start_date"
                                   @if($work_plan != null)
                                   value="{{$work_plan->active_suffrage_start_date}}"
                                @endif
                            >
                        <p><label for="">по:</label></p>
                            <input type="text" placeholder="18 июня" name="active_suffrage_end_date"
                                   @if($work_plan != null)
                                   value="{{$work_plan->active_suffrage_end_date}}"
                                @endif
                            >
                        </p>
                    </div>
                    <div class="fields">
                        <p>
                            <p><label for="">С:</label></p>
                            <input type="text" placeholder="8.00" name="active_suffrage_start_time"
                                     @if($work_plan != null)
                                     value="{{$work_plan->active_suffrage_start_time}}"
                                @endif
                            >
                            <p><label for="">до:</label></p>
                            <input type="text" placeholder="18.00" name="active_suffrage_end_time"
                                      @if($work_plan != null)
                                      value="{{$work_plan->active_suffrage_end_time}}"
                                @endif
                            >
                        </p>
                    </div>
                    <div class="fields">
                        <p>
                            <label for="">Открытие помещения для голосования в:</label>
                            <input type="text" placeholder="8.00" name="active_suffrage_open_voting_room_time"
                                   @if($work_plan != null)
                                   value="{{$work_plan->active_suffrage_open_voting_room_time}}"
                                @endif
                            > часов.
                        </p>
                    </div>
                    <div class="fields">
                        <p> Обеспечение реализации активного избирательного права избирателей, голосующих в помещении для голосования
                            <p><label for="">С:</label></p>
                            <input type="text" placeholder="8.00" name="active_suffrage_in_opening_voting_room_start_time"
                                     @if($work_plan != null)
                                     value="{{$work_plan->active_suffrage_in_opening_voting_room_start_time}}"
                                @endif
                            >
                            <p><label for="">до:</label></p>
                            <input type="text" placeholder="18.00" name="active_suffrage_in_opening_voting_room_end_time"
                                      @if($work_plan != null)
                                      value="{{$work_plan->active_suffrage_in_opening_voting_room_end_time}}"
                                @endif
                            > часов.
                        </p>
                    </div>
                    <div class="fields">
                        <p> Обеспечение реализации активного избирательного права избирателей, голосующих вне помещения для голосования
                            <p><label for="">С:</label></p>
                            <input type="text" placeholder="8.00" name="active_suffrage_out_opening_voting_room_start_time"
                                     @if($work_plan != null)
                                     value="{{$work_plan->active_suffrage_out_opening_voting_room_start_time}}"
                                @endif
                            >
                            <p><label for="">до:</label></p>
                            <input type="text" placeholder="18.00" name="active_suffrage_out_opening_voting_room_end_time"
                                      @if($work_plan != null)
                                      value="{{$work_plan->active_suffrage_out_opening_voting_room_end_time}}"
                                @endif
                            > часов.
                        </p>
                    </div>
                    <div class="fields">
                        <label for=""> Сдача упакованных избирательных документов в ТИК. Не позднее:</label>
                            <input type="text" placeholder="19.07.2021" name="submission_documents_date"
                                   @if($work_plan != null)
                                   value="{{$work_plan->submission_documents_date}}"
                                @endif
                            >
                    </div>
                    <div class="fields">
                        <label for="">Подготовка и представление в ТИК отчетов о расходовании и использовании денежных средств, выделенных УИК. Не позднее:</label>
                            <input type="text" placeholder="20.07.2021" name="preparation_submission_reports_date"
                                   @if($work_plan != null)
                                   value="{{$work_plan->preparation_submission_reports_date}}"
                                @endif
                            >
                    </div>
                    <div class="block-btn">
                        <button class="btn-submit" type="submit" form="UpdateWorkPlan" class="btn">
                            Сохранить
                        </button>
                    </div>
                </form>
            </div>
        </div>