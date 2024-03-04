@extends('admin.base', [
    'title' => 'Test',
    'active' => 'tests',
    'subActive' => 'test-list'
])

@section('content')
@if($errors->any())
    <div class="badge-danger row mb-4 p-2 rounded text-center">
            @foreach ($errors->all() as $error )
                <div class="col-12 mx-4"><i class="bi bi-exclamation-triangle-fill pr-2"></i>{{$error}}</div>
            @endforeach
    </div>
@endif
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Liste des Questions de la onlineclass </h4>
                <button class="btn btn-primary" data-toggle="modal" data-target="#addModal">Ajouter une question</button>
                <!-- ADD Modal -->
                <div class="modal fade" id="addModal">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Créer une nouvelle question</h5>
                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                </button>
                            </div>
                            <form action="{{route('admin.onlineClass.quiz.store')}}" method="post">
                                @csrf
                                <input type="hidden" name="course" value="{{$course->id}}">
                                <div class="modal-body">
                                    <label for="" class="text-primary required">Question</label>
                                    <input class="form-control form-control-lg" type="text" value="{{old('question')}}" name="question" placeholder="">
                                </div>
                                <div class="modal-body">
                                    <label for="" class="text-primary required">Réponse 1</label>
                                    <input class="form-control form-control-lg" type="text" value="{{old('response_1')}}" name="response_1" placeholder="">
                                </div>
                                <div class="modal-body">
                                    <label for="" class="text-primary required">Réponse 2</label>
                                    <input class="form-control form-control-lg" type="text" value="{{old('response_2')}}" name="response_2" placeholder="">
                                </div>
                                <div class="modal-body">
                                    <label for="" class="text-primary required">Réponse 3</label>
                                    <input class="form-control form-control-lg" type="text" value="{{old('response_3')}}" name="response_3" placeholder="">
                                </div>
                                <div class="modal-body">
                                    <label for="" class="text-primary required">Réponse correcte</label>
                                    <select name="response" class="form form-control" id="">
                                        <option value="1" @if(old('response') == 1) selected="selected" @endif>1</option>
                                        <option value="2" @if(old('response') == 2) selected="selected" @endif>2</option>
                                        <option value="3" @if(old('response') == 3) selected="selected" @endif>3</option>
                                    </select>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="display" style="min-width: 845px">
                        <thead>
                            <tr class="text-center">
                                <th>Numéro</th>
                                <th>Question</th>
                                <th>Réponse 1</th>
                                <th>Réponse 2</th>
                                <th>Réponse 3</th>
                                <th>Réponse correcte</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($questions as $question)
                                <tr class="text-center">
                                    <td>{{$question->id}}</td>
                                    <td>{{$question->question}}</td>
                                    <td>{{$question->response_1}}</td>
                                    <td>{{$question->response_2}}</td>
                                    <td>{{$question->response_3}}</td>
                                    <td>{{$question->response}}</td>
                                    <td>
                                        <button data-toggle="modal" data-target="#updateModal{{$question->id}}" class="btn btn-success text-white">Modifier</button>
                                        <!-- UPDATE Modal -->
                                        <div class="modal fade" id="updateModal{{$question->id}}">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Créer un nouveau type d'article</h5>
                                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{route('admin.onlineClass.quiz.update')}}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{$question->id}}">
                                                        <div class="modal-body">
                                                            <label for="" class="text-primary required">Question</label>
                                                            <input class="form-control form-control-lg" type="text" value="{{$question->question}}" name="question" placeholder="">
                                                        </div>
                                                        <div class="modal-body">
                                                            <label for="" class="text-primary required">Réponse 1</label>
                                                            <input class="form-control form-control-lg" type="text" value="{{$question->response_1}}" name="response_1" placeholder="">
                                                        </div>
                                                        <div class="modal-body">
                                                            <label for="" class="text-primary required">Réponse 2</label>
                                                            <input class="form-control form-control-lg" type="text" value="{{$question->response_2}}" name="response_2" placeholder="">
                                                        </div>
                                                        <div class="modal-body">
                                                            <label for="" class="text-primary required">Réponse 3</label>
                                                            <input class="form-control form-control-lg" type="text" value="{{$question->response_3}}" name="response_3" placeholder="">
                                                        </div>
                                                        <div class="modal-body">
                                                            <label for="" class="text-primary required">Réponse correcte</label>
                                                            <select name="response" class="form form-control" id="">
                                                                <option value="1" @if($question->response == 1) selected="selected" @endif>1</option>
                                                                <option value="2" @if($question->response == 2) selected="selected" @endif>2</option>
                                                                <option value="3" @if($question->response == 3) selected="selected" @endif>3</option>
                                                            </select>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                                                            <button type="submit" class="btn btn-primary">Enregistrer</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal{{$question->id}}">Supprimer</button>
                                        <!-- DELETE Modal -->
                                        <div class="modal fade" id="deleteModal{{$question->id}}">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Supprimer un type d'article</h5>
                                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{route('admin.onlineClass.quiz.delete')}}" method="post">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <input type="hidden" name="id" value="{{$question->id}}">
                                                            <div class="text-center text-black">
                                                                Êtes vous sûr de vouloir exécuter cette action ? <br/>
                                                                Cette action est irreversible !
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-primary" data-dismiss="modal">Fermer</button>
                                                            <button type="submit" class="btn btn-danger">Supprimer</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="text-center">
                            <th>Numéro</th>
                            <th>Question</th>
                            <th>Réponse 1</th>
                            <th>Réponse 2</th>
                            <th>Réponse 3</th>
                            <th>Réponse correcte</th>
                            <th>Action</th>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

