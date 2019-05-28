<?php
namespace \

App::uses('Component', 'Controller');
class AclSessionComponent extends Component
{
    public $components = array('Session');

    public function encrypt($dataArray)
    {
        $listaEncriptada = Security::rijndael(serialize($dataArray), Configure::read('Security.salt'), 'encrypt');
        $this->Session->write('encryptedData', $listaEncriptada);
        return true;
    }

    public function decrypt()
    {
        if ($this->Session->check('encryptedData')) {
            $aclListDecrypt = unserialize(
                Security::rijndael(
                    $this->Session->read('encryptedData'),
                    Configure::read('Security.salt'),
                    'decrypt'
                )
            );
            return $aclListDecrypt;
        } else {
            return false;
        }
    }

    public function destroy()
    {
        if ($this->Session->check('encryptedData')) {
            $this->Session->delete('encryptedData');
            return true;
        } else {
            return false;
        }
    }

    public function check($id)
    {
        $encryptedData = $this->decrypt();

        if (array_key_exists((int)$id, $encryptedData)) {
            return true;
        } else {
            return false;
        }
    }
}
