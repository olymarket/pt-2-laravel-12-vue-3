<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRequest;
use Illuminate\Support\Facades\{
    Validator,
    DB
};
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    public function index()
    {
        try{
            $agenda = DB::select(
                'SELECT
                    idAgenda,
                    name,
                    phone,
                    DATE_FORMAT(date, "%Y-%M-%d-%W") AS date
                FROM agenda 
                ORDER BY idAgenda DESC'
            );
            if(empty($agenda)){
                return response()->json([
                    'statu'   => 'error',
                    'message' => 'Data not found',
                    'agendas'  => $agenda,
                ],404);
            }
            elseif(!empty($agenda)){
                return response()->json([
                    'statu'   => 'success',
                    'message' => 'Found data',
                    'agendas'  => $agenda,
                ],200);
            }
        }catch(Exception $e){
            return response()->json([
                'statu'   => 'error',
                'message' => 'Error in stored procedures',
                'errors'  => $e->getMessage(),
            ], 500);
        }
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {        
        try{
            $rules = [
                'name' => [
                    'required',
                    'min:3',
                    'max:30'
                ],
                'phone' => [
                    'required',
                    'digits:10'
                ],
                'date' => [
                    'required',
                    'date',
                    'before:2100-01-01',
                    'after:1900-01-01'
                ]
            ];
        
            $messages = [
                'name.required'   => 'name required',
                'name.min'        => '3 characters minimum',
                'name.max'        => '30 characters maximum',

                'phone.required'   => 'phone required',
                'phone.digits'     => '10 characters minimum',

                'date.required'   => 'date required',
                'date.date'       => 'only date',
                'date.after'      => 'The year must be after 1900',
                    'date.before'     => 'The year must not be greater than 2100',
            ];
        
            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                return response()->json([
                    'statu'   => 'error',
                    'message' => 'Corrects the following errors',
                    'errors'  => $validator->errors()
                ], 422);
            }
            else{
                $name      = e($request->input('name'));
                $phone     = e($request->input('phone'));
                $date      = e($request->input('date'));
                
                DB::insert('INSERT INTO agenda (name, phone, date) VALUES (?,?,?)',[
                    $name,
                    $phone,
                    $date
                ]);
        
                return response()->json([
                    'statu'   => 'success',
                    'message' => 'Save data',
                ], 200);
            }
        }
        catch(Exception $e){
            return response()->json([
                'statu'   => 'error',
                'message' => 'Error in stored procedures',
                'errors'  => $e->getMessage(),
            ],500);
        }
    }

    public function show()
    {
        //
    }

    public function edit($idAgenda)
    {
        try{
            $agenda = DB::select('SELECT idAgenda, name, phone, date 
                FROM agenda
                WHERE idAgenda = ?', [$idAgenda]
            );
            if(empty($agenda)){
                return response()->json([
                    'statu'   => 'error',
                    'message' => 'Data not found',
                    'agenda'  => $agenda,
                ],404);
            }
            elseif(!empty($agenda)){
                return response()->json([
                    'statu'   => 'success',
                    'message' => 'Found data',
                    'agenda'  => $agenda[0],
                ],200);
            }
        }catch(Exception $e){
            return response()->json([
                'statu'   => 'error',
                'message' => 'Error in stored procedures',
                'errors'  => $e->getMessage(),
            ], 500);
        }

    }

    public function update(Request $request, $idAgenda)
    {
        try{
            $agenda = DB::select("SELECT idAgenda FROM agenda WHERE idAgenda = ?", [$idAgenda]);

            if(empty($agenda)){
                return response()->json([
                    'statu'    => 'error',
                    'message'  => 'This record does not exist',
                    'redirect' => route('agenda.index')
                ],404);
            }
            elseif(!empty($agenda)){
                $rules = [
                    'name' => [
                        'required',
                        'min:3',
                        'max:30'
                    ],
                    'phone' => [
                        'required',
                        'digits:10'
                    ],
                    'date' => [
                        'required',
                        'date',
                        'before:2100-01-01',
                        'after:1900-01-01'
                    ]
                ];
            
                $messages = [
                    'name.required'   => 'name required',
                    'name.min'        => '3 characters minimum',
                    'name.max'        => '30 characters maximum',

                    'phone.required'   => 'phone required',
                    'phone.digits'     => '10 characters minimum',

                    'date.required'   => 'date required',
                    'date.date'       => 'only date',
                    'date.after'      => 'The year must be after 1900',
                    'date.before'     => 'The year must not be greater than 2100',
                ];
            
                $validator = Validator::make($request->all(), $rules, $messages);
                if ($validator->fails()) {
                    return response()->json([
                        'statu'   => 'error',
                        'message' => 'Corrects the following errors',
                        'errors'  => $validator->errors()
                    ], 422);
                }
                else{
                    $name      = e($request->input('name'));
                    $phone     = e($request->input('phone'));
                    $date      = e($request->input('date'));
            
                    $post = DB::update('UPDATE agenda SET name = ?, phone = ?, date = ? WHERE idAgenda = ?',[
                        $name,
                        $phone,
                        $date,
                        $idAgenda
                    ]);
            
                    return response()->json([
                        'statu'   => 'success',
                        'message' => 'Update data',
                    ], 200);
                }
            }
        }
        catch(Exception $e){
            return response()->json([
                'statu'   => 'error',
                'message' => 'Error in stored procedures',
                'errors'  => $e->getMessage(),
            ],500);
        }
    }

    public function destroy($idAgenda)
    {
        try{
            $agenda = DB::select("SELECT idAgenda FROM agenda WHERE idAgenda = ?", [$idAgenda]);

            if(empty($agenda)){
                return response()->json([
                    'statu'    => 'error',
                    'message'  => 'This record does not exist',
                ],404);
            }
            elseif(!empty($agenda)){
                
                $agenda = DB::delete("DELETE FROM agenda WHERE idAgenda = ?", [$idAgenda]);

                return response()->json([
                    'statu'   => 'success',
                    'message' => 'Delete data',
                    'agenda'  => $agenda,
                ], 200);
            }
        }catch(Exception $e){
            return response()->json([
                'statu'   => 'error',
                'message' => 'Error in stored procedures',
                'errors'  => $e->getMessage(),
            ], 500);
        }
    }
}
