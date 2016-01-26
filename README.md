# ProntoPro.it - PHPTest
##### Autore: Paolo Treu [treu.paolo@gmail.com](mailto:treu.paolo@gmail.com), [kurlic@hotmail.com](mailto:kurlic@hotmail.com)

Il progetto è stato scritto utilizzando il framework **YII 1.1.17**.

Dopo aver comunque testato *Symfony* per capirne le differente rispetto a Yii e non avendone notate di sostanziali, ho deciso di utilizzare un framework differente per snellire e velocizzare lo sviluppo del progetto.

A ogni modo tale framework rispetta le specifiche in modo che:
- il pattern utilizzato si *MVC*;
- la connessione ad una ase dati utilizzi la tecnica *ORM* come *Doctrine* (che sarebbe comunque utilizzabile come estensione ma renderebbe più macchinoso e meno efficente il codice da scrivere in quanto non direttamente integrato nel framework) i cui repository sono i Model di Yii. E' inoltre stata utilizzata la generazione delle operazioni *CRUD* direttamente dal database, sulla base delle tabelle presenti;
- l'utilizzo di bundle/package/component viene effettuato con module/extension/component;
- l'upload è stato gestito sfruttando un componente interno al framework molto efficente e comunque facile da usare.

Per la configurazione non è necessario nulla di più di un web server con *PHP* con estensione *pdo_sqlite* abilitata (ad esempio il server built-in di php,apache,nginx,iis).

I path del progetto sono tutti relativi quindi basta effettuare il checkout nella cartella desiderata.

Grazie per l'opportunità e...
>che la forza sia con me! ;)

Paolo
