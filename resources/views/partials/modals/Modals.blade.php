@if($id == 1)
    <!-- Modal Passport en -->
    <div class="modal fade" id="document-{{ $id }}-modal">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Passport</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="g-wrapper mb-0">
                        <form action="{{ route('download-template.download', ['id' => $id, 'language' => $language]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('POST')

                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group g-form-group">
                                        <label>Type</label>
                                        <input type="text" class="form-control g-form-control" name="type" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group g-form-group">
                                        <label>Country code</label>
                                        <input type="text" class="form-control g-form-control" name="country_code" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group g-form-group">
                                        <label>Series number</label>
                                        <input type="text" class="form-control g-form-control" name="series_number" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group g-form-group">
                                        <label>Surname</label>
                                        <input type="text" class="form-control g-form-control" name="surname" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group g-form-group">
                                        <label>Name</label>
                                        <input type="text" class="form-control g-form-control" name="name" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group g-form-group">
                                        <label>Father’s name</label>
                                        <input type="text" class="form-control g-form-control" name="middle_name" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group g-form-group">
                                        <label>Nationality</label>
                                        <input type="text" class="form-control g-form-control" name="nationality" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group g-form-group">
                                        <label>Date of Birth</label>
                                        <input type="date" class="form-control g-form-control" name="date_of_birth" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group g-form-group">
                                        <label>Place of Birth</label>
                                        <input type="text" class="form-control g-form-control" name="place_of_birth" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group g-form-group-sm">
                                        <div>
                                            <label class="d-block mb-2">Sex</label>
                                            <div class="g-form-control">
                                                <label class="g-radio label-row p-0 w-100">
                                                    <input type="radio" name="sex" value="Male">
                                                    <span>Male</span>
                                                </label>
                                                <label class="g-radio label-row p-0 w-100">
                                                    <input type="radio" name="sex" value="Female">
                                                    <span>Female</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group g-form-group">
                                        <label>Issued date</label>
                                        <input type="date" class="form-control g-form-control" name="issued_date" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group g-form-group">
                                        <label>Valid until</label>
                                        <input type="date" class="form-control g-form-control" name="valid_until" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group g-form-group">
                                        <label>Issued by</label>
                                        <input type="text" class="form-control g-form-control" name="issued_by" required>
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="form-group g-form-group">
                                        <label>The passport is valid in foreign countries until</label>
                                        <input type="date" class="form-control g-form-control" name="valid_foreign_countries_date" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group g-form-group">
                                        <label>Registration place</label>
                                        <input type="text" class="form-control g-form-control" name="registration_place" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group g-form-group">
                                        <label>Authority</label>
                                        <input type="number" class="form-control g-form-control" name="authority" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group g-form-group">
                                        <label>Registration date</label>
                                        <input type="date" class="form-control g-form-control" name="registration_date" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-12">
                                    <label class="g-type-file g-type-file-1">
                                        <input type="file" name="passport_image">
                                        Passport image
                                        <i class="fas fa-upload"></i>
                                    </label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group g-form-group mb-0 text-center">
                                        <button class="g-btn g-btn-blue-ol g-btn-round" data-dismiss="modal" type="button">{{ __('pages.Cancel') }}</button>
                                        <button type="submit" class="g-btn g-btn-blue g-btn-round download-document">{{ __('pages.Download') }}</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

@if($id == 2)
    <!-- Modal Passport ru -->
    <div class="modal fade" id="document-{{ $id }}-modal">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">ПАСПОРТ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="g-wrapper mb-0">
                        <form action="{{ route('download-template.download', ['id' => $id, 'language' => $language]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('POST')

                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group g-form-group">
                                        <label>Тип</label>
                                        <input type="text" class="form-control g-form-control" name="type" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group g-form-group">
                                        <label>Код страны</label>
                                        <input type="text" class="form-control g-form-control" name="country_code" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group g-form-group">
                                        <label>Серия и номер</label>
                                        <input type="text" class="form-control g-form-control" name="series_number" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group g-form-group">
                                        <label>Фамилия</label>
                                        <input type="text" class="form-control g-form-control" name="surname" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group g-form-group">
                                        <label>Имя</label>
                                        <input type="text" class="form-control g-form-control" name="name" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group g-form-group">
                                        <label>Отчество</label>
                                        <input type="text" class="form-control g-form-control" name="middle_name" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group g-form-group">
                                        <label>Гражданство</label>
                                        <input type="text" class="form-control g-form-control" name="nationality" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group g-form-group">
                                        <label>Дата рождения</label>
                                        <input type="date" class="form-control g-form-control" name="date_of_birth" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group g-form-group">
                                        <label>Место рождения</label>
                                        <input type="text" class="form-control g-form-control" name="place_of_birth" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group g-form-group-sm">
                                        <div>
                                            <label class="d-block mb-2">Пол</label>
                                            <div class="g-form-control">
                                                <label class="g-radio label-row p-0 w-100">
                                                    <input type="radio" name="sex" value="Мужской">
                                                    <span>Мужской</span>
                                                </label>
                                                <label class="g-radio label-row p-0 w-100">
                                                    <input type="radio" name="sex" value="Женский">
                                                    <span>Женский</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group g-form-group">
                                        <label>Выдан</label>
                                        <input type="date" class="form-control g-form-control" name="issued_date" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group g-form-group">
                                        <label>Действителен до</label>
                                        <input type="date" class="form-control g-form-control" name="valid_until" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group g-form-group">
                                        <label>Кем выдан</label>
                                        <input type="text" class="form-control g-form-control" name="issued_by" required>
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="form-group g-form-group">
                                        <label>Паспорт действителен в зарубежных странах до</label>
                                        <input type="date" class="form-control g-form-control" name="valid_foreign_countries_date" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group g-form-group">
                                        <label>Регистрация по адресу</label>
                                        <input type="text" class="form-control g-form-control" name="registration_place" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group g-form-group">
                                        <label>Орган</label>
                                        <input type="number" class="form-control g-form-control" name="authority" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group g-form-group">
                                        <label>Дата регистрации</label>
                                        <input type="date" class="form-control g-form-control" name="registration_date" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-12">
                                    <label class="g-type-file g-type-file-1">
                                        <input type="file" name="passport_image">
                                        Паспортное изображение
                                        <i class="fas fa-upload"></i>
                                    </label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group g-form-group mb-0 text-center">
                                        <button class="g-btn g-btn-blue-ol g-btn-round" data-dismiss="modal" type="button">{{ __('pages.Cancel') }}</button>
                                        <button type="submit" class="g-btn g-btn-blue g-btn-round download-document">{{ __('pages.Download') }}</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

@if($id == 3)
    <!-- Modal Birth Certificate ru -->
    <div class="modal fade" id="document-3-modal">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">СВИДЕТЕЛЬСТВО О РОЖДЕНИИ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="g-wrapper mb-0">

                        <form action="{{ route('download-template.download', ['id' => $id, 'language' => $language]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('POST')

                            <fieldset class="g-fieldset">
                                <legend>Гражданин (ка)</legend>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group g-form-group">
                                            <label>фамилия</label>
                                            <input type="text" class="form-control g-form-control" name="surname" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group g-form-group">
                                            <label>Имя</label>
                                            <input type="text" class="form-control g-form-control" name="name" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group g-form-group">
                                            <label>Отчество</label>
                                            <input type="text" class="form-control g-form-control" name="middle_name" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group g-form-group mb-0">
                                            <label>Дата рождения</label>
                                            <input type="date" class="form-control g-form-control" name="date_of_birth" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group g-form-group mb-0">
                                            <label>Место рождения</label>
                                            <input type="text" class="form-control g-form-control" name="place_of_birth" required>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>

                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="form-group g-form-group">
                                        <label>О чем в книге регистрации актов о рождении</label>
                                        <input type="text" class="form-control g-form-control" name="book_register" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group g-form-group">
                                        <label>Составлена запись №</label>
                                        <input type="number" class="form-control g-form-control" name="recorded" required>
                                    </div>
                                </div>
                            </div>

                            <p class="text-center">РОДИТЕЛИ:</p>

                            <fieldset class="g-fieldset">
                                <legend>Отец</legend>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group g-form-group">
                                            <label>фамилия</label>
                                            <input type="text" class="form-control g-form-control" name="father_surname" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group g-form-group">
                                            <label>Имя</label>
                                            <input type="text" class="form-control g-form-control" name="father_name" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group g-form-group mb-0">
                                            <label>Отчество</label>
                                            <input type="text" class="form-control g-form-control" name="father_middle_name" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group g-form-group mb-0">
                                            <label>Национальность</label>
                                            <input type="text" class="form-control g-form-control" name="father_nationality" required>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset class="g-fieldset">
                                <legend>Мать</legend>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group g-form-group">
                                            <label>фамилия</label>
                                            <input type="text" class="form-control g-form-control" name="mother_surname" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group g-form-group">
                                            <label>имя</label>
                                            <input type="text" class="form-control g-form-control" name="mother_name" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group g-form-group mb-0">
                                            <label>Отчество</label>
                                            <input type="text" class="form-control g-form-control" name="mother_middle_name" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group g-form-group mb-0">
                                            <label>Национальность</label>
                                            <input type="text" class="form-control g-form-control" name="mother_nationality" required>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>

                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="form-group g-form-group">
                                        <label>Место регистрации</label>
                                        <input type="text" class="form-control g-form-control" name="registration_place" placeholder="наименование и местонахождения органа" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group g-form-group">
                                        <label>Дата выдачи</label>
                                        <input type="date" class="form-control g-form-control" name="issue_date" required>
                                    </div>
                                </div>
                            </div>

                            <p class="font-weight-bold">Подписано заведующим (ей) отдела (бюро) записи актов гражданского состояния.</p>

                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group g-form-group">
                                        <p class="mb-0">Документ несет ГЕРБОВУЮ ПЕЧАТЬ территориального отдела</p>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group g-form-group">
                                        <input type="text" class="form-control g-form-control" name="territorial_department" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group g-form-group">
                                        <p class="mb-0">агентства ЗАГС Министерства Юстиции Республики Армения.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group g-form-group">
                                        <label>Номер документа</label>
                                        <input type="text" class="form-control g-form-control" name="document_number" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group g-form-group mb-0 text-center">
                                        <button class="g-btn g-btn-blue-ol g-btn-round" data-dismiss="modal" type="button">{{ __('pages.Cancel') }}</button>
                                        <button type="submit" class="g-btn g-btn-blue g-btn-round download-document">{{ __('pages.Download') }}</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

@if($id == 4)
    <!-- Modal Birth Certificate en -->
    <div class="modal fade" id="document-4-modal">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Birth Certificate</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="g-wrapper mb-0">

                        <form action="{{ route('download-template.download', ['id' => $id, 'language' => $language]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('POST')

                            <fieldset class="g-fieldset">
                                <legend>Гражданин (ка)</legend>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group g-form-group">
                                            <label>Surname</label>
                                            <input type="text" class="form-control g-form-control" name="surname" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group g-form-group">
                                            <label>Name</label>
                                            <input type="text" class="form-control g-form-control" name="name" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group g-form-group">
                                            <label>Father’s name</label>
                                            <input type="text" class="form-control g-form-control" name="middle_name" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group g-form-group mb-0">
                                            <label>Nationality</label>
                                            <input type="text" class="form-control g-form-control" name="nationality" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group g-form-group mb-0">
                                            <label>Date of birth</label>
                                            <input type="date" class="form-control g-form-control" name="date_of_birth" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group g-form-group mb-0">
                                            <label>Place of birth</label>
                                            <input type="text" class="form-control g-form-control" name="place_of_birth" required>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>

                            <p class="text-center">PARENTS:</p>

                            <fieldset class="g-fieldset">
                                <legend>Father</legend>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group g-form-group">
                                            <label>Surname</label>
                                            <input type="text" class="form-control g-form-control" name="father_surname" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group g-form-group">
                                            <label>Name</label>
                                            <input type="text" class="form-control g-form-control" name="father_name" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group g-form-group mb-0">
                                            <label>Father’s name</label>
                                            <input type="text" class="form-control g-form-control" name="father_middle_name" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group g-form-group mb-0">
                                            <label>Nationality</label>
                                            <input type="text" class="form-control g-form-control" name="father_nationality" required>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset class="g-fieldset">
                                <legend>Мать</legend>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group g-form-group">
                                            <label>Surname</label>
                                            <input type="text" class="form-control g-form-control" name="mother_surname" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group g-form-group">
                                            <label>Name</label>
                                            <input type="text" class="form-control g-form-control" name="mother_name" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group g-form-group mb-0">
                                            <label>Father’s name</label>
                                            <input type="text" class="form-control g-form-control" name="mother_middle_name" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group g-form-group mb-0">
                                            <label>Nationality</label>
                                            <input type="text" class="form-control g-form-control" name="mother_nationality" required>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>

                            <p class="font-weight-bold">in witness whereof, an entry was recorded in the United Electronic Register of Civil Status Acts Registration of the Republic of Armenia</p>

                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="form-group g-form-group">
                                        <label>Date of entry</label>
                                        <input type="date" class="form-control g-form-control" name="date_of_entry" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group g-form-group">
                                        <label>Registration number</label>
                                        <input type="text" class="form-control g-form-control" name="registration_number" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group g-form-group">
                                        <label>Registration body</label>
                                        <input type="text" class="form-control g-form-control" name="registration_body" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group g-form-group">
                                        <label>Date</label>
                                        <input type="date" class="form-control g-form-control" name="date" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group g-form-group mb-0 text-center">
                                        <button class="g-btn g-btn-blue-ol g-btn-round" data-dismiss="modal" type="button">{{ __('pages.Cancel') }}</button>
                                        <button type="submit" class="g-btn g-btn-blue g-btn-round download-document">{{ __('pages.Download') }}</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

@if($id == 5)
    <!-- Modal Death Certificate ru -->
    <div class="modal fade" id="document-5-modal">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">СВИДЕТЕЛЬСТВО О СМЕРТИ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="g-wrapper mb-0">

                        <form action="{{ route('download-template.download', ['id' => $id, 'language' => $language]) }}" method="POST">
                            @csrf
                            @method('POST')

                            <fieldset class="g-fieldset">
                                <legend>Гражданин (ка) РА</legend>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group g-form-group">
                                            <label>фамилия</label>
                                            <input type="text" class="form-control g-form-control" name="surname" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group g-form-group">
                                            <label>Имя</label>
                                            <input type="text" class="form-control g-form-control" name="name" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group g-form-group">
                                            <label>Отчество</label>
                                            <input type="text" class="form-control g-form-control" name="middle_name" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group g-form-group">
                                            <label>Дата рождения</label>
                                            <input type="date" class="form-control g-form-control" name="date_of_birth" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group g-form-group">
                                            <label>Место рождения</label>
                                            <input type="date" class="form-control g-form-control" name="place_of_birth" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group g-form-group">
                                            <label>Национальность</label>
                                            <input type="text" class="form-control g-form-control" name="nationality" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group g-form-group">
                                            <label>Дата смерти</label>
                                            <input type="date" class="form-control g-form-control" name="date_of_death" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group g-form-group mb-0">
                                            <input type="text" class="form-control g-form-control" name="date_of_death_text" placeholder="Дата смерти (буквами)" required>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group g-form-group">
                                        <label>О чем в книге регистрации актов о смерти</label>
                                        <input type="date" class="form-control g-form-control" name="book_register" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group g-form-group">
                                        <label>Произведена запись за №</label>
                                        <input type="number" class="form-control g-form-control" name="produced_record" required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group g-form-group">
                                        <label>Причина смерти</label>
                                        <textarea class="form-control g-form-control" name="cause_death" required></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group g-form-group">
                                        <label>Место смерти</label>
                                        <input type="text" class="form-control g-form-control" name="death_place" required placeholder="(республика, город, село)">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group g-form-group">
                                        <label>Смерть регистрирована</label>
                                        <input type="text" class="form-control g-form-control" name="death_registered" placeholder="(наименование и местонахождения органа)" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group g-form-group">
                                        <label>Дата выдачи</label>
                                        <input type="date" class="form-control g-form-control" name="issue_date" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group g-form-group">
                                        <label>Номер документа</label>
                                        <input type="text" class="form-control g-form-control" name="document_number" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group g-form-group mb-0 text-center">
                                        <button class="g-btn g-btn-blue-ol g-btn-round" data-dismiss="modal" type="button">{{ __('pages.Cancel') }}</button>
                                        <button type="submit" class="g-btn g-btn-blue g-btn-round download-document">{{ __('pages.Download') }}</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

@if($id == 6)
    <!-- Modal Death Certificate en -->
    <div class="modal fade" id="document-6-modal">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Death Certificate</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="g-wrapper mb-0">

                        <form action="{{ route('download-template.download', ['id' => $id, 'language' => $language]) }}" method="POST">
                            @csrf
                            @method('POST')

                            <fieldset class="g-fieldset">
                                <legend>Citizen</legend>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group g-form-group">
                                            <label>Surname</label>
                                            <input type="text" class="form-control g-form-control" name="surname" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group g-form-group">
                                            <label>Name</label>
                                            <input type="text" class="form-control g-form-control" name="name" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group g-form-group">
                                            <label>Father’s name</label>
                                            <input type="text" class="form-control g-form-control" name="middle_name" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group g-form-group mb-0">
                                            <label>Nationality</label>
                                            <input type="text" class="form-control g-form-control" name="nationality" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group g-form-group mb-0">
                                            <label>Date of birth</label>
                                            <input type="date" class="form-control g-form-control" name="date_of_birth" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group g-form-group mb-0">
                                            <label>Place of birth</label>
                                            <input type="text" class="form-control g-form-control" name="place_of_birth" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group g-form-group mb-0">
                                            <label>Citizenship</label>
                                            <input type="text" class="form-control g-form-control" name="citizenship" required>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset class="g-fieldset">
                                <legend>Died</legend>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group g-form-group mb-0">
                                            <label>Date of death</label>
                                            <input type="date" class="form-control g-form-control" name="date_of_death" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group g-form-group mb-0">
                                            <label>Cause of death</label>
                                            <input type="text" class="form-control g-form-control" name="cause_of_death" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group g-form-group mb-0">
                                            <label>Place of death</label>
                                            <input type="text" class="form-control g-form-control" name="place_of_death" required>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>

                            <p class="font-weight-bold">In witness whereof, the entry was recorded in the United Electronic Registry of Civil Status Acts Registration of the Republic of Armenia</p>

                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="form-group g-form-group">
                                        <label>Date of entry</label>
                                        <input type="date" class="form-control g-form-control" name="date_of_entry" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group g-form-group">
                                        <label>Registration number</label>
                                        <input type="text" class="form-control g-form-control" name="registration_number" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group g-form-group">
                                        <label>Registration body</label>
                                        <input type="text" class="form-control g-form-control" name="registration_body" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group g-form-group">
                                        <label>Date</label>
                                        <input type="date" class="form-control g-form-control" name="date" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group g-form-group mb-0 text-center">
                                        <button class="g-btn g-btn-blue-ol g-btn-round" data-dismiss="modal" type="button">{{ __('pages.Cancel') }}</button>
                                        <button type="submit" class="g-btn g-btn-blue g-btn-round download-document">{{ __('pages.Download') }}</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

@if($id == 7)
    <!-- Modal Marriage Certificate en -->
    <div class="modal fade" id="document-7-modal">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">CERTIFICATE OF CONCLUSION OF MARRIAGE</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="g-wrapper mb-0">
                        <form action="{{ route('download-template.download', ['id' => $id, 'language' => $language]) }}" method="POST">
                            @csrf
                            @method('POST')

                            <fieldset class="g-fieldset">
                                <legend>Citizen of the United States of America</legend>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group g-form-group">
                                            <label>Last name</label>
                                            <input type="text" class="form-control g-form-control" name="husband_surname" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group g-form-group">
                                            <label>Name</label>
                                            <input type="text" class="form-control g-form-control" name="husband_name" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group g-form-group">
                                            <label>Patronymic name</label>
                                            <input type="text" class="form-control g-form-control" name="husband_lastname" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group g-form-group mb-0">
                                            <label>Born on</label>
                                            <input type="date" class="form-control g-form-control" name="husband_birth_day" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group g-form-group mb-0">
                                            <label>Place of birth</label>
                                            <input type="text" class="form-control g-form-control" name="husband_birth_place" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group g-form-group mb-0">
                                            <label>Nationality</label>
                                            <input type="text" class="form-control g-form-control" name="husband_nationality" required>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset class="g-fieldset">
                                <legend>Citizen of the Republic of Armenia</legend>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group g-form-group">
                                            <label>Last name</label>
                                            <input type="text" class="form-control g-form-control" name="wife_surname" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group g-form-group">
                                            <label>Name</label>
                                            <input type="text" class="form-control g-form-control" name="wife_name" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group g-form-group">
                                            <label>Patronymic name</label>
                                            <input type="text" class="form-control g-form-control" name="wife_lastname" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group g-form-group mb-0">
                                            <label>Born on</label>
                                            <input type="date" class="form-control g-form-control" name="wife_birth_day" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group g-form-group mb-0">
                                            <label>Place of birth</label>
                                            <input type="text" class="form-control g-form-control" name="wife_birth_place" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group g-form-group mb-0">
                                            <label>Nationality</label>
                                            <input type="text" class="form-control g-form-control" name="wife_nationality" required>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>

                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group g-form-group">
                                        <label>was recorded in the Marriage Register on</label>
                                        <input type="number" class="form-control g-form-control" name="produced_record" required>
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="form-group g-form-group0">
                                        <label>were joined in marriage, in witness whereof, the entry under №</label>
                                        <input type="date" class="form-control g-form-control" name="book_register" required>
                                    </div>
                                </div>
                            </div>

                            <fieldset class="g-fieldset">
                                <legend>The married spouses will bear the following surnames:</legend>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group g-form-group mb-0">
                                            <label>Husband</label>
                                            <input type="text" class="form-control g-form-control" name="book_register_husband" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group g-form-group mb-0">
                                            <label>Wife</label>
                                            <input type="text" class="form-control g-form-control" name="book_register_wife" required>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>

                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="form-group g-form-group">
                                        <label>Place of registration</label>
                                        <input type="text" class="form-control g-form-control" name="registration_place" required placeholder="наименование и местонахождения органа">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group g-form-group">
                                        <label>The Certificate was issued on</label>
                                        <input type="date" class="form-control g-form-control" name="issue_date" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group g-form-group mb-0 text-center">
                                        <button class="g-btn g-btn-blue-ol g-btn-round" data-dismiss="modal" type="button">{{ __('pages.Cancel') }}</button>
                                        <button type="submit" class="g-btn g-btn-blue g-btn-round download-document">{{ __('pages.Download') }}</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

@if($id == 8)
    <!-- Modal Marriage Certificate ru -->
    <div class="modal fade" id="document-8-modal">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">СВИДЕТЕЛЬСТВО О ЗАКЛЮЧЕНИИ БРАКА</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="g-wrapper mb-0">
                        <form action="{{ route('download-template.download', ['id' => $id, 'language' => $language]) }}" method="POST">
                            @csrf
                            @method('POST')

                            <fieldset class="g-fieldset">
                                <legend>Гражданин РА</legend>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group g-form-group">
                                            <label>фамилия</label>
                                            <input type="text" class="form-control g-form-control" name="husband_surname" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group g-form-group">
                                            <label>Имя</label>
                                            <input type="text" class="form-control g-form-control" name="husband_name" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group g-form-group">
                                            <label>Отчество</label>
                                            <input type="text" class="form-control g-form-control" name="husband_middle_name" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group g-form-group mb-0">
                                            <label>Дата рождения</label>
                                            <input type="date" class="form-control g-form-control" name="husband_birth_date" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group g-form-group mb-0">
                                            <label>Место рождения</label>
                                            <input type="text" class="form-control g-form-control" name="husband_birth_place" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group g-form-group mb-0">
                                            <label>Национальность</label>
                                            <input type="text" class="form-control g-form-control" name="husband_nationality" required>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset class="g-fieldset">
                                <legend>Гражданка РА</legend>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group g-form-group">
                                            <label>фамилия</label>
                                            <input type="text" class="form-control g-form-control" name="wife_surname" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group g-form-group">
                                            <label>Имя</label>
                                            <input type="text" class="form-control g-form-control" name="wife_name" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group g-form-group">
                                            <label>Отчество</label>
                                            <input type="text" class="form-control g-form-control" name="wife_middle_name" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group g-form-group mb-0">
                                            <label>Дата рождения</label>
                                            <input type="date" class="form-control g-form-control" name="wife_birth_date" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group g-form-group mb-0">
                                            <label>Место рождения</label>
                                            <input type="text" class="form-control g-form-control" name="wife_birth_place" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group g-form-group mb-0">
                                            <label>Национальность</label>
                                            <input type="text" class="form-control g-form-control" name="wife_nationality" required>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>

                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="form-group g-form-group0">
                                        <label>Вступили в брак, о чем в книге регистрации актов о браке</label>
                                        <input type="date" class="form-control g-form-control" name="book_register" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group g-form-group">
                                        <label>Произведена запись за №</label>
                                        <input type="number" class="form-control g-form-control" name="produced_record" required>
                                    </div>
                                </div>
                            </div>

                            <fieldset class="g-fieldset">
                                <legend>После заключения брака присвоены фамилии</legend>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group g-form-group mb-0">
                                            <label>Мужу</label>
                                            <input type="text" class="form-control g-form-control" name="book_register_husband" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group g-form-group mb-0">
                                            <label>Жене</label>
                                            <input type="text" class="form-control g-form-control" name="book_register_wife" required>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>

                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="form-group g-form-group">
                                        <label>Место регистрации</label>
                                        <input type="text" class="form-control g-form-control" name="registration_place" required placeholder="наименование и местонахождения органа">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group g-form-group">
                                        <label>Дата выдачи</label>
                                        <input type="date" class="form-control g-form-control" name="issue_date" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group g-form-group">
                                        <label>Номер документа</label>
                                        <input type="text" class="form-control g-form-control" name="document_number" required="">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group g-form-group mb-0 text-center">
                                        <button class="g-btn g-btn-blue-ol g-btn-round" data-dismiss="modal" type="button">{{ __('pages.Cancel') }}</button>
                                        <button type="submit" class="g-btn g-btn-blue g-btn-round download-document">{{ __('pages.Download') }}</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
