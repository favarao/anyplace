<div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="d-none sb-sidenav-menu-heading">Titulo</div>
                            <a class="nav-link" href="/">
                                Home
                            </a>
                            <?php if(allow('1')):?>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseClientes" aria-expanded="false" aria-controls="collapseLayouts">
                                Clientes <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>                                
                            </a>
                            <div class="collapse link-group" id="collapseClientes" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                    <a class="nav-link" href="/clientes">Clientes</a>
                                    <a class="nav-link" href="/addcliente">Cliente Adicionar</a>
                            </div>
                            <?php endif;?>
                            <?php if(allow('1,2')):?>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseProdutos" aria-expanded="false" aria-controls="collapsePages">
                                Produtos <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse link-group" id="collapseProdutos" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <a class="nav-link no-border" href="/produtos">Produtos</a>
                                <?php if(allow('1,2')):?>
                                <a class="nav-link" href="/addproduto">Produto Adicionar</a>
                                <?php endif;?>
                            </div>
                            <?php endif;?>
                            <?php if(allow('1,2')):?>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseVendas" aria-expanded="false" aria-controls="collapsePages">
                                Vendas <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse link-group" id="collapseVendas" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <a class="nav-link no-border" href="index.php">Home</a>
                                <a class="nav-link" href="index.php">Home</a>
                            </div>

                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseAnuncios" aria-expanded="false" aria-controls="collapsePages">
                                Anuncios <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse link-group" id="collapseAnuncios" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <a class="nav-link" href="promocoes">Gerenciar Promoções</a>
                            </div>

                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseContasReceber" aria-expanded="false" aria-controls="collapsePages">
                                Contas a Receber <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse link-group" id="collapseContasReceber" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <a class="nav-link no-border" href="gerar-contas-receber.php">Gerar contas a receber</a>
                                <a class="nav-link" href="baixar-contas-receber.php">Baixar contas a receber</a>
                            </div>

                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseRelatorios" aria-expanded="false" aria-controls="collapsePages">
                                Relatorios <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse link-group" id="collapseRelatorios" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <a class="nav-link no-border" href="relatorio-contas-receber.php">Contas a Receber</a>
                                <a class="nav-link" href="index.php">Home</a>
                            </div>

                           
                        <?php endif;?>
                        <?php if(allow('1,2')):?>
                            <a class="nav-link collapsed" style="<?php if(!empty(Configuracao::alertaNegociacao()) && allow('1')) echo 'background:orange;color:white;'?>" href="#" data-bs-toggle="collapse" data-bs-target="#collapseConfiguracoes" aria-expanded="false" aria-controls="collapsePages">
                                Configurações <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse link-group" id="collapseConfiguracoes" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <a class="nav-link no-border" style="<?php if(!empty(Configuracao::alertaNegociacao()) && allow('1')) echo 'background:orange;color:white;'?>" href="/negociarComissao">Negociar Comissão</a>
                            </div>
                            <?php if(allow('1')):?>
                            <div class="collapse link-group" id="collapseConfiguracoes" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <a class="nav-link no-border" href="/configuracao">Parametrização</a>
                            </div>
                            <?php endif;?>
                        <?php endif;?>
                        </div>
                    </div>
                </nav>
            </div>