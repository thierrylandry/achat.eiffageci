<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="update" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 class="modal-title">Modifier un fournisseur</h4>
            </div>
            <div class="modal-body">

                <form role="form" class="bucket-form" method="post" action="{{route('updatefournisseur')}}">
                    @csrf
                    <div class="form-group">
                        <b><label for="libelle" class="control-label">Libelle</label></b>
                        <input type="text" class="form-control" id="libelle" name="libelle" placeholder="libelle" required>
                    </div>
                    <div class="form-group">
                        <label for="domaine">Domaine</label>
                        <input type="text" class="form-control" id="domaine" name="domaine" placeholder="Domaine" required>
                    </div>   <div class="form-group">
                        <label for="domaine">Adresse Géographique</label>
                        <input type="text" class="form-control" id="adresseGeographique" name="adresseGeographique" placeholder="Domaine">
                    </div>
                    <div class="form-group">
                        <label for="domaine">Condition de paiement</label>
                        <input type="text" class="form-control" id="conditionPaiement" name="conditionPaiement" placeholder="Condition de Paiement">
                    </div>

                    <div class="form-group">
                        <label for="responsable">Responsable</label>
                        <input type="text" class="form-control" id="responsable" name="responsable" placeholder="responsable">
                    </div>
                    <div class="form-group">
                        <label for="interlocuteur">Interlocuteur</label>
                        <input type="text" class="form-control" id="interlocuteur" name="interlocuteur" placeholder="interlocuteur" required>
                    </div>
                    <div class="form-group">
                        <label for="email">E - mail</label>
                        <input type="text" class="form-control" id="email" name="email" placeholder="E -mail" required>
                    </div>
                    <div class="form-group">
                        <label for="commentaire">Commentaire</label>
                        <textarea id="commentaire" name="commentaire" class="form-control col-sm-8"></textarea>
                    </div>
                    <br><div class="form-group" >
                        <button type="submit" class="btn btn-success form-control">Modifier le fournisseur</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

