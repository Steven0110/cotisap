<?php

namespace App\Http\Controllers;

use App\Lib\Libraries as Lib;
use Illuminate\Http\Request;

class TransferenciaController extends Controller
{
	public function Index(){
		return view('theme.transferencias.createTransfer',[
			'Series' => self::getSeries()
		]);
	}

	public function SolicitudTransferenia(){
		return view('theme.transferencias.SolicitudDeTraslado',[
			'Series' => self::getSeries(),
			'DocNum' => self::DocNum(),
			'Almacenes' => self::FindAllAlmacen(),
			'GroupLists' => self::FindAllGroupList(),
			'Proyectos' => self::getProjectAll()
		]);
	}

	public function getSeries(){
		return Lib::querySQLSRV("
			SELECT 
				Series, SeriesName
			FROM NNM1
				WHERE
			DocSubType = 'DN'", null);
	}

	public function searchDocument(Request $request){
		
		$params  = array();
		$query = "
				SELECT
					DocNum,
		 			CardCode,
		 			CardName,
		 			CONVERT(DATE,DocDate,103) AS 'DocDate',
		 			DocTotal,
		 			Filler as 'origen',
		 			ToWhsCode as 'destino'
				FROM OWTQ 
					WHERE  
					 u_intsucursal = 1
		";

		if ($request->Series and $request->Series != 0 ) {
			$query .= " AND Series = ? ";
			$params[] = $request->Series;
		}

		if ($request->DocNum) {
			$query .= " AND DocNum = ? ";
			$params[] = $request->DocNum;
		}

		if ($request->CardCode) {
			$query .= " AND CardCode = ? ";
			$params[] = $request->CardCode;
		}

		if ($request->CardName) {
			$query .= " AND CardName = ? ";
			$params[] = $request->CardName;
		}

		if ($request->DocDate) {
			$query .= " AND DocDate = ? ";
			$params[] = $request->DocDate;
		}

		if ($request->DocDueDate) {
			$query .= " AND DocDueDate = ? ";
			$params[] = $request->DocDueDate;
		}

		if ($request->TaxDate) {
			$query .= " AND TaxDate = ? ";
			$params[] = $request->TaxDate;
		}

		if ($request->BPLId) {
			$query .= " AND BPLId = ? ";
			$params[] = $request->BPLId;
		}

		if ($request->Filler) {
			$query .= " AND Filler = ? ";
			$params[] = $request->Filler;
		}

		if ($request->ToWhsCode) {
			$query .= " AND ToWhsCode = ? ";
			$params[] = $request->ToWhsCode;
		}


		$docOWTQ = Lib::querySQLSRV($query, $params);
		return array('data' => $docOWTQ);

	}

	/*
	 * Regresa el número del documento deseado.
	 */

	public function DocNum(){

		return  Lib::querySQLSRV("SELECT TOP 1 DocNum FROM OWTQ WHERE DocNum LIKE '11%' ORDER BY DocNum DESC", null);
	}


	/*
	 * Buscar por código del socio de negocios
	 */

	public function FindAllByCardCode(Request $request){

		$term=$request->term;

		return  Lib::querySQLSRV("
					SELECT  
						CardCode AS	id,
						CardCode AS value
					FROM OCRD 
					WHERE 
						CardCode LIKE ?
						AND VatStatus = 'Y' 
						AND CardType = 'C' 
					ORDER BY CardCode ASC
			", [ "%".$term."%" ]);

	}

	/*
	 * Buscar por nombre del socio de negocios
	 */

	public function FindAllByCardName(Request $request){

		$term=$request->term;

		return  Lib::querySQLSRV("
					SELECT  
						CardCode AS	id,
						CardName AS value
					FROM OCRD 
					WHERE 
						CardName LIKE ?
						AND VatStatus = 'Y' 
						AND CardType = 'C' 
					ORDER BY CardCode ASC
			", [ "%".$term."%" ]);

	}


	/*
	 * Detalle del cliente
	 */

	public function FindAllInfo(Request $request){

		$datos = array();
		$id = $request->id;

		$contacto = Lib::querySQLSRV("
			SELECT TOP 1 CntctCode,Name FROM OCPR WHERE CardCode = ? ORDER BY CntctCode ASC	
			", [ $id ]);

		array_push($datos, $contacto);

		$direccion = Lib::querySQLSRV("
			SELECT TOP 1
				Address
			FROM CRD1 WHERE CardCode = ? ORDER BY Address DESC", [ $id ]);

		array_push($datos, $direccion);

		$dato = Lib::querySQLSRV("
			SELECT  
				CardCode AS	CardCode,
				CardName AS CardName
			FROM OCRD 
			WHERE 
				CardCode = 'C1-0001'
				AND VatStatus = 'Y' 
				AND CardType = 'C' 
			ORDER BY CardCode ASC", [ $id ]);

		array_push($datos, $dato);

		return $datos;


	}


	/*
	 * Seleccionar almacen
	 */

	public function FindAllAlmacen(){

		return Lib::querySQLSRV2("
					SELECT
					 WhsCode,
					 WhsName,
					 ( 
					  SELECT
					 	BPLName
					  FROM OBPL T2 WHERE T2.BPLId = T1.BPLid
					 ) AS Sucursal
					FROM OWHS T1
					WHERE WhsName <> ''
			", null );

	}


	/*
	 * Seleccionar todas las listas de precios
	 */

	public function FindAllGroupList(){

		return Lib::querySQLSRV2("
			(SELECT
			  ListNum, ListName
				FROM OPLN )
				UNION (
					SELECT -2, 'Último precio determinado'
				)
				UNION (
					SELECT -1, 'Último precio de compra'
				)
				ORDER BY ListNum ASC 
			", null);
	}

	/*
	 * Regresar datos del articulo
	 */

	public function FindAllProduct(Request $request){

		$term=$request->term;

		return Lib::querySQLSRV2("
				SELECT TOP 20
					ItemCode AS	id,
					ItemCode AS value
				 FROM OITM WHERE ItemCode LIKE ? ORDER BY ItemCode ASC
			",[ "%".$term."%" ]);

	}

	/*
	 * Regresar datos del articulo
	 */

	public function FindAllProductName(Request $request){

		$term=$request->term;

		return Lib::querySQLSRV2("
				SELECT TOP 20
					ItemCode AS	id,
					ItemName AS value
				 FROM OITM WHERE ItemName LIKE ? ORDER BY ItemName ASC
			",[ "%".$term."%" ]);

	}

    /*
	 * Regresar datos del articulo
	 */

	public function FindAllProductById(Request $request){

		$term=$request->id;

		return Lib::querySQLSRV2("
				SELECT 
					ItemCode AS	id,
					ItemName AS value
				 FROM OITM WHERE ItemCode = ?
			",[ $term ]);

	}


	/*
	 * Proyecto
	 */

	public function getProjectAll(){

		return Lib::querySQLSRV2("
				SELECT PrjCode FROM OPRJ
			", null);
	}

}
