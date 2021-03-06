<?php $this->Combinator->add_libs('css', $this->Less->css('about_us')) ?>

<div id="fb-root"></div>

<div id="aboutUs" class="container">
    <div class="row">
        <div class="content col-xs-12 col-lg-10 col-lg-offset-1">
            <div class="mainContent block">
                <div class="col-xs-12 col-md-8">
                    <div class="sector">
                        <a target="_blank" href="http://epf.org.pl">
                            <img id="epf_logo" src="../img/logo-epanstwo.svgz" alt="Logotyp Fundacji ePaństwo"
                                 width="40%"/>
                        </a>

                        <p>Wydawcą portalu mojePaństwo jest <a href="http://epf.org.pl" target="_blank">Fundacja
                                ePaństwo</a> - niezależna organizacja pozarządowa działająca na rzecz rozwoju demokracji
                            w Polsce.</p>
                    </div>

                    <h2>Kontakt z redakcją:</h2>

                    <div class="sector">
                        <p>
                            E-mail: <a href="mailto:biuro@epf.org.pl">biuro@epf.org.pl</a>
                            <br/>
                            Telefon: <a href="skype:224074204">(22) 40 74 204</a>
                        </p>
                    </div>

                    <h2>O portalu:</h2>

                    <p>_mojePaństwo to następca serwisu sejmometr.pl. Jest zestawem aplikacji, dzięki którym możesz
                        kontrolować i wpływać na działania Twojego państwa. Serwis mojePaństwo jest projektem Open
                        Source, w którym każdy może wziąć udział. Kod źródłowy oraz system zgłaszania błędów i
                        propozycji (issues) dostępny jest w serwisie <a
                            href="https://github.com/epforgpl" target="_blank">GitHub</a> w postaci trzech
                        repozytoriów:</p>
                    <ul>
                        <li><a href="https://github.com/epforgpl/_mojePanstwo-Portal" target="_blank">_mojePanstwo
                                Portal</a> - jest
                            głównym kodem źródłowym serwisu. Odpowiada za obsługę i wizualizacje wszelkich aplikacji
                            dostępnych w portalu. Działa w oparciu o środowisko CakePHP 2.x.
                        </li>
                        <li><a href="https://github.com/epforgpl/_mojePanstwo-API-Client-PHP" target="_blank">_mojePanstwo
                                API Client
                                PHP</a> - jest klientem działającym w środowisku PHP, za pośrednictwem którego Portal
                            łączy się z Serwerem danych.
                        </li>
                        <li><a href="https://github.com/epforgpl/_mojePanstwo-API-Server" target="_blank">_mojePanstwo
                                API Server</a>
                            - jest Serwerem danych, z którego korzysta Portal.
                        </li>
                    </ul>

                    <h2>Wykorzystywanie danych:</h2>

                    <div class="sector">
                        <p>Fundacja ePaństwo stara się strukturalizować, wzbogacać oraz łączyć informacje, które
                            pozyskuje w ramach ponownego wykorzystywania informacji z sektora publicznego. W takim
                            przypadku może powstać chroniony <a target="_self"
                                                                title="Ustawa z dnia 4 lutego 1994 r. o prawie autorskim i prawach pokrewnych."
                                                                href="/dane/prawo/51613">prawem autorskim</a> utwór.
                            Starania Fundacji dotyczace strukturalizacji danych mogą też powodować, że korzystający z
                            portalu _mojePaństwo będą korzystali z bazy danych, o której mowa w <a target="_self"
                                                                                                   title="Ustawa z dnia 27 lipca 2001 r. o ochronie baz danych"
                                                                                                   href="/dane/prawo/1777">ustawie
                                o ochronie baz danych</a>.</p>

                        <p>Fundacja ePaństwo niniejszym udziela "wolnej licencji" na udostępniane w ramach portalu
                            mojePaństwo utwory i bazy danych, do których przysługują jej autorskie prawa majątkowe oraz
                            prawa pokrewne, a jedynym warunkiem takiej licencji - w przypadku tworzenia aplikacji
                            wykorzystujących dane udostępniane przez Fundację - jest umieszczenie informacji o
                            pochodzeniu danych wraz z linkiem do serwisu <a
                                href="http://mojepanstwo.pl">mojePaństwo.pl</a>.
                        </p>
                    </div>


                </div>

                <div class="sideContent hidden-xs hidden-sm col-md-4">
                    <div class="fb-like-box" data-href="https://www.facebook.com/mojepanstwo"
                         data-width="90%"
                         data-height="540" data-show-faces="true" data-stream="true" data-border-color="#FFFFFF"
                         data-header="true"></div>
                </div>
            </div>

            <div class="fundatorzy block">
                <h2>Sponsorzy projektu:</h2>

                <div class="sector">
                    <div id="fundatorzy">
                        <div class="part">
                            <p class="info">Projekt realizowany w ramach programu Obywatele dla Demokracji,
                                finansowanego z Funduszy EOG:</p>

                            <div class="logotypy">
                                <a target="_blank" href="http://www.eeagrants.org/" title="EEA Grants">
                                    <img class="image" src="/img/partnerzy/eea_grants.png"/>
                                </a>
                                <a target="_blank" href="http://www.batory.org.pl/"
                                   title="Fundacja im. Stefana Batorego">
                                    <img class="image" src="/img/partnerzy/fundacja_batorego.png"/>
                                </a>
                                <a target="_blank" href="http://www.pcyf.org.pl/"
                                   title="Polska Fundacja Dzieci i Młodzieży">
                                    <img class="image" src="/img/partnerzy/polska_fundacja_dzieci_i_mlodziezy.png"/>
                                </a>

                            </div>
                        </div>

                        <div class="part">
                            <p class="info">Wspierają nas także:</p>

                            <div class="logotypy">
                                <a target="_blank" href="http://www.soros.org/initiatives/information"
                                   title="Open Society Foundations (OSF) Information Program">
                                    <img class="image" src="/img/partnerzy/open_society_institute.png"/>
                                </a>
                                <a target="_blank" href="http://www.mysociety.org/" title="mySociety">
                                    <img class="image" src="/img/partnerzy/mysociety.png"/>
                                </a>
                                <a target="_blank" href="http://www.omidyar.com/" title="Omidyar Network">
                                    <img class="image" src="/img/partnerzy/omidyar_network.png"/>
                                </a>
                                <a target="_blank" href="http://www.ceetrust.org/"
                                   title="CEE TRUST - Trust for Civil Society in Central and Eastern Europe">
                                    <img class="image" src="/img/partnerzy/cee_logo.gif"/>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
