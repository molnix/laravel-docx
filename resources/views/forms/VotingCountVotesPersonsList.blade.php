<div id="VotingCountVotesPersonsList" class="tab-content tab-content_overflow">
            <div class="popup__wrapper">
                <div class="cl-btn-7" onclick="close_popups()"></div>
                <h2>СПИСОК лиц, присутствовавших при проведении голосования, подсчете голосов избирателей</h2>
                <a href="{{route('download_voting_count_votes_persons_list',['id'=>$voting->id])}}">Скачать файл</a>
                <form id="UpdateVotingCountVotesPersonsList" class="form_overflow" action="{{route('create_voting_count_votes_persons_list',['id'=>$voting->id])}}" method="post">
                    @csrf
                    <div>
                        <table style="width:100%;">
                            <thead>
                            <tr>
                                <td>№</td>
                                <td>Фамилия, имя, отчество</td>
                                <td>Статус присутствовавшего лица (с указанием вида выборов)</td>
                                <td>Кого представляет</td>
                                <td>Контактный телефон и адрес места жительства</td>
                                <td>Указанное лицо присутствовало с __ч.</td>
                                <td>Указанное лицо присутствовало с __мин.</td>
                                <td>Указанное лицо присутствовало по __ч.</td>
                                <td>Указанное лицо присутствовало по __мин.</td>
                                <td>Удалить строку</td>
                            </tr>
                            </thead>
                            <tbody id="VotingCountVotesPersonsListTable">
                            @if(isset($voting_count_votes_persons_lists))
                                @foreach($voting_count_votes_persons_lists as $voting_count_votes_persons_list)
                                    <tr class="voting_count_votes_persons_list_inputs">
                                        <td>
                                            <input type="number" name="number[]" value="{{$voting_count_votes_persons_list->number}}">
                                        </td>
                                        <td>
                                            <input type="text" name="name[]" value="{{$voting_count_votes_persons_list->name}}" list="WorkersDatalist" autocomplete="no">
                                        </td>
                                        <td>
                                            <input type="text" name="status[]" value="{{$voting_count_votes_persons_list->status}}">
                                        </td>
                                        <td>
                                            <input type="text" name="represent[]" value="{{$voting_count_votes_persons_list->represent}}" list="WorkersDatalist" autocomplete="no">
                                        </td>
                                        <td>
                                            <input type="text" name="contact[]" value="{{$voting_count_votes_persons_list->contact}}">
                                        </td>
                                        <td>
                                            <input type="text" name="hours_start[]" value="{{$voting_count_votes_persons_list->hours_start}}">
                                        </td>
                                        <td>
                                            <input type="text" name="minuts_start[]" value="{{$voting_count_votes_persons_list->minuts_start}}">
                                        </td>
                                        <td>
                                            <input type="text" name="hours_end[]" value="{{$voting_count_votes_persons_list->hours_end}}">
                                        </td>
                                        <td>
                                            <input type="text" name="minuts_end[]" value="{{$voting_count_votes_persons_list->minuts_end}}">
                                        </td>
                                        <td>
                                            <button class="btn-danger-table" type="button" onclick="$(this).closest('.voting_count_votes_persons_list_inputs').remove();">Удалить строку</button>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                        <div class="block-btn">
                            <button id="CreateVotingCountVotesPersonsListBtn" class="btn-blue" type="button">Создать ячейки</button>
                            <button id="DeleteVotingCountVotesPersonsListBtn" class="btn-danger" type="button">Удалить ячейки</button>
                        </div>
                    </div>
                    <div class="block-btn">
                        <button class="btn-submit" type="submit" form="UpdateVotingCountVotesPersonsList" class="btn">
                            Сохранить
                        </button>
                    </div>
                </form>
            </div>
        </div>