
            <div class="modal fade" id="delete-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel"><i class="fa-solid fa-triangle-exclamation"></i> Atenção:</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        Deseja mesmo excluir este Gerente?
                        </div>
                        <div class="modal-footer">
                        <a  href="#" id="confirm" class="btn btn-light" data-bs-dismiss="modal">Não</a>
                        <a href="deleteAdm.php?id=<?php echo $adm['id']; ?>" class="btn btn btn-light" data-toggle="modal" data-target="#delete-modal" data-adm="<?php echo $adm['id']; ?>">Sim</a>
                        </div>
                    </div>
                </div>
            </div>

