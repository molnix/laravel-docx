<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogOutgoingPECDocumentsRegistration extends Model
{
    protected $table='log_outgoing_p_e_c_documents_registrations';
    protected $fillable=[
        'voting_id',
        'date',
        'number',
        'recipient',
        'summary_document',
        'person_signed_doc',
        'executor',
        'case',
    ];
}
