<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // ROLE
        Permission::create(['name' => 'view role']);
        Permission::create(['name' => 'delete role']);
        Permission::create(['name' => 'add role']);
        Permission::create(['name' => 'edit role']);

        // PERMISSION
        Permission::create(['name' => 'view permission']);
        Permission::create(['name' => 'delete permission']);
        Permission::create(['name' => 'add permission']);
        Permission::create(['name' => 'edit permission']);

        // USER BASED PERMISSION
        Permission::create(['name' => 'asign userBasedPermission']);

        // ROLE BASED PERMISSION
        Permission::create(['name' => 'asign roleBasedPermission']);

        //ASIGN ROLE TO USER

        Permission::create(['name' => 'asign roleToUser']);
        Permission::create(['name' => 'revoke roleToUser']);

        // prefix
        Permission::create(['name' => 'prefix']);
        Permission::create(['name' => 'view prefix']);
        Permission::create(['name' => 'add prefix']);
        Permission::create(['name' => 'edit prefix']);
        Permission::create(['name' => 'delete prefix']);

        //user
        Permission::create(['name' => 'Human Resource']);
        Permission::create(['name' => 'User']);
        Permission::create(['name' => 'User Add']);
        Permission::create(['name' => 'User List']);
        Permission::create(['name' => 'user profile']);
        Permission::create(['name' => 'user active deactive']);
        Permission::create(['name' => 'user edit']);
        Permission::create(['name' => 'Change Password']);
        Permission::create(['name' => 'user delete']);

        //General Setting
        Permission::create(['name' => 'Set Up']);

        //Item Stock Related
        Permission::create(['name' => 'General Setting']);

        //patient

        Permission::create(['name' => 'Patient Master']);
        Permission::create(['name' => 'edit patient']);
        Permission::create(['name' => 'delete patient']);
        Permission::create(['name' => 'add patient']);

        Permission::create(['name' => 'search patient']);


        //Bed Master
        Permission::create(['name' => 'Bed Master']);

        //bed
        Permission::create(['name' => 'bed']);
        Permission::create(['name' => 'add bed']);
        Permission::create(['name' => 'delete bed']);
        Permission::create(['name' => 'edit bed']);

        // bedUnit
        Permission::create(['name' => 'bed unit']);
        Permission::create(['name' => 'add bed unit']);
        Permission::create(['name' => 'delete bed unit']);
        Permission::create(['name' => 'edit bed unit']);

        // bedType
        Permission::create(['name' => 'bed type']);
        Permission::create(['name' => 'add bed type']);
        Permission::create(['name' => 'delete bed type']);
        Permission::create(['name' => 'edit bed type']);

        //floor
        Permission::create(['name' => 'floor']);
        Permission::create(['name' => 'add floor']);
        Permission::create(['name' => 'edit floor']);
        Permission::create(['name' => 'delete floor']);

        //ward
        Permission::create(['name' => 'ward']);
        Permission::create(['name' => 'add ward']);
        Permission::create(['name' => 'edit ward']);
        Permission::create(['name' => 'delete ward']);


        //bedgroup
        Permission::create(['name' => 'bedgroup']);
        Permission::create(['name' => 'add bedgroup']);
        Permission::create(['name' => 'edit bedgroup']);
        Permission::create(['name' => 'delete bedgroup']);

        //Department
        Permission::create(['name' => 'Department']);
        Permission::create(['name' => 'edit department']);
        Permission::create(['name' => 'delete department']);
        Permission::create(['name' => 'add department']);

        //Dashboard
        Permission::create(['name' => 'Dashboard']);

        //bed status
        Permission::create(['name' => 'Bed Status']);

        //charges main menu
        Permission::create(['name' => 'charges']);
        Permission::create(['name' => 'charges unit']);
        Permission::create(['name' => 'charges sub catagory']);
        Permission::create(['name' => 'charges catagory']);
        Permission::create(['name' => 'Charges Master']);

        //charges sub menu
        Permission::create(['name' => 'add charges']);
        Permission::create(['name' => 'delete charges']);
        Permission::create(['name' => 'edit charges']);

        //import patient
        Permission::create(['name' => 'import patient']);


        //charges catagory
        Permission::create(['name' => 'charges add catagory']);
        Permission::create(['name' => 'charges edit catagory']);
        Permission::create(['name' => 'charges delete catagory']);


        //charges sub catagory
        Permission::create(['name' => 'charges add sub catagory']);
        Permission::create(['name' => 'charges edit sub catagory']);
        Permission::create(['name' => 'charges delete sub catagory']);

        //charges unit
        Permission::create(['name' => 'charges add unit']);
        Permission::create(['name' => 'charges edit unit']);
        Permission::create(['name' => 'charges delete unit']);


        //All Header
        Permission::create(['name' => 'All Header']);

        //Operation
        Permission::create(['name' => 'Master Operation']);

        //Operation
        Permission::create(['name' => 'operation']);
        Permission::create(['name' => 'add operation']);
        Permission::create(['name' => 'edit operation']);
        Permission::create(['name' => 'delete operation']);

        //operation catagory
        Permission::create(['name' => 'operation catagory']);
        Permission::create(['name' => 'add operation catagory']);
        Permission::create(['name' => 'edit operation catagory']);
        Permission::create(['name' => 'delete operation catagory']);

        //operation type
        Permission::create(['name' => 'operation type']);
        Permission::create(['name' => 'add operation type']);
        Permission::create(['name' => 'edit operation type']);
        Permission::create(['name' => 'delete operation type']);



        //opd
        Permission::create(['name' => 'Opd']);
        Permission::create(['name' => 'opd unit']);
        Permission::create(['name' => 'add opd unit']);
        Permission::create(['name' => 'edit opd unit']);
        Permission::create(['name' => 'delete opd unit']);

        //opd setup
        Permission::create(['name' => 'opd setup']);
        Permission::create(['name' => 'add opd setup']);
        Permission::create(['name' => 'edit opd setup']);
        Permission::create(['name' => 'delete opd setup']);

        //opd setup
        Permission::create(['name' => 'opd ticket fees']);
        Permission::create(['name' => 'add opd ticket fees']);
        Permission::create(['name' => 'edit opd ticket fees']);
        Permission::create(['name' => 'delete opd ticket fees']);


        //symptoms
        Permission::create(['name' => 'symptoms']);

        //symptoms head
        Permission::create(['name' => 'symptoms head']);
        Permission::create(['name' => 'add symptoms head']);
        Permission::create(['name' => 'edit symptoms head']);
        Permission::create(['name' => 'delete symptoms head']);

        //symptoms head
        Permission::create(['name' => 'symptoms type']);
        Permission::create(['name' => 'add symptoms type']);
        Permission::create(['name' => 'edit symptoms type']);
        Permission::create(['name' => 'delete symptoms type']);

        //diagonasis
        Permission::create(['name' => 'diagonasis']);
        Permission::create(['name' => 'add diagonasis']);
        Permission::create(['name' => 'edit diagonasis']);
        Permission::create(['name' => 'delete diagonasis']);

        // TPA management
        Permission::create(['name' => 'tpa management']);
        Permission::create(['name' => 'add tpa management']);
        Permission::create(['name' => 'edit tpa management']);
        Permission::create(['name' => 'delete tpa management']);

        // Blood Bank Product
        Permission::create(['name' => 'blood bank']);

        Permission::create(['name' => 'blood bank product']);
        Permission::create(['name' => 'add blood bank product']);
        Permission::create(['name' => 'edit blood bank product']);
        Permission::create(['name' => 'delete blood bank product']);

        // Appointment
        Permission::create(['name' => 'appointment']);

        //shift
        Permission::create(['name' => 'shift']);
        Permission::create(['name' => 'add shift']);
        Permission::create(['name' => 'edit shift']);
        Permission::create(['name' => 'delete shift']);

        //slots
        Permission::create(['name' => 'slots']);
        Permission::create(['name' => 'add slots']);
        Permission::create(['name' => 'edit slots']);
        Permission::create(['name' => 'delete slots']);
        //OPD out-patients
        Permission::create(['name' => 'OPD out-patients']);
        Permission::create(['name' => 'OPD registation']);
        Permission::create(['name' => 'OPD profile']);
        Permission::create(['name' => 'Admission From OPD']);
        Permission::create(['name' => 'delete opd patient']);
        Permission::create(['name' => 'edit opd patient']);

        //past date admission
        Permission::create(['name' => 'appointment date']);


        //Finding

        Permission::create(['name' => 'Finding']);
        Permission::create(['name' => 'finding category']);
        Permission::create(['name' => 'edit finding category']);
        Permission::create(['name' => 'delete finding category']);
        Permission::create(['name' => 'add finding category']);
        Permission::create(['name' => 'add finding']);
        Permission::create(['name' => 'edit finding']);
        Permission::create(['name' => 'delete finding']);




        // Pathology
        Permission::create(['name' => 'pathology']);

        // Pathology Catagory
        Permission::create(['name' => 'pathology catagory']);
        Permission::create(['name' => 'add pathology catagory']);
        Permission::create(['name' => 'edit pathology catagory']);
        Permission::create(['name' => 'delete pathology catagory']);

        // Pathology Unit
        Permission::create(['name' => 'pathology unit']);
        Permission::create(['name' => 'add pathology unit']);
        Permission::create(['name' => 'edit pathology unit']);
        Permission::create(['name' => 'delete pathology unit']);

        // Pathology parameter
        Permission::create(['name' => 'pathology parameter']);
        Permission::create(['name' => 'add pathology parameter']);
        Permission::create(['name' => 'edit pathology parameter']);
        Permission::create(['name' => 'delete pathology parameter']);

        // Pathology main
        Permission::create(['name' => 'pathology main']);

        Permission::create(['name' => 'edit pathology test']);
        Permission::create(['name' => 'delete pathology test']);
        //pathology bill
        Permission::create(['name' => 'pathology billing list']);
        Permission::create(['name' => 'add pathology bill']);
        //pathology test
        Permission::create(['name' => 'pathology test']);
        Permission::create(['name' => 'add pathology test']);

        //pathology test master
        Permission::create(['name' => 'pathology test master']);
        Permission::create(['name' => 'add pathology test master']);

        //pathology package
        Permission::create(['name' => 'pathology Package']);
        Permission::create(['name' => 'view pathology package']);
        Permission::create(['name' => 'add pathology package']);


        // Birth and Death Record
        Permission::create(['name' => 'Birth and Death Record']);

        Permission::create(['name' => 'death record']);
        Permission::create(['name' => 'add death record']);
        Permission::create(['name' => 'edit death record']);
        Permission::create(['name' => 'delete death record']);

        Permission::create(['name' => 'birth record']);
        Permission::create(['name' => 'add birth record']);
        Permission::create(['name' => 'edit birth record']);
        Permission::create(['name' => 'delete birth record']);

        //Emg patients
        Permission::create(['name' => 'Emg patients']);
        Permission::create(['name' => 'Emg registation']);
        Permission::create(['name' => 'emg patient profile']);
        Permission::create(['name' => 'print emg registation copy']);
        Permission::create(['name' => 'edit emg registation']);
        Permission::create(['name' => 'delete emg registation']);
        Permission::create(['name' => 'Admission From EMG']);


        //emg setup

        Permission::create(['name' => 'Emg setUp']);
        //'  Permission::create(['name' => 'Emg registation']);




        // Radiology
        Permission::create(['name' => 'radiology']);

        // Appointment
        Permission::create(['name' => 'appointment main']);
        Permission::create(['name' => 'add appointment main']);
        Permission::create(['name' => 'edit appointment main']);
        Permission::create(['name' => 'delete appointment main']);

        // Front Office
        Permission::create(['name' => 'front office']);
        Permission::create(['name' => 'visit list']);
        Permission::create(['name' => 'add visit']);
        Permission::create(['name' => 'delete visit']);
        Permission::create(['name' => 'edit visit']);

        // Call Log
        Permission::create(['name' => 'call log']);
        Permission::create(['name' => 'add call log']);
        Permission::create(['name' => 'delete call log']);
        Permission::create(['name' => 'edit call log']);

        // Complain
        Permission::create(['name' => 'complain']);
        Permission::create(['name' => 'add complain']);
        Permission::create(['name' => 'edit complain']);
        Permission::create(['name' => 'delete complain']);

        // Postal Receive
        Permission::create(['name' => 'postal receive']);
        Permission::create(['name' => 'add postal receive']);
        Permission::create(['name' => 'edit postal receive']);
        Permission::create(['name' => 'delete postal receive']);

        // Postal Dispatch
        Permission::create(['name' => 'postal dispatch']);
        Permission::create(['name' => 'add postal dispatch']);
        Permission::create(['name' => 'edit postal dispatch']);
        Permission::create(['name' => 'delete postal dispatch']);

        //Ipd ipd-patients
        Permission::create(['name' => 'IPD ipd-patients']);
        Permission::create(['name' => 'IPD registation']);
        Permission::create(['name' => 'edit IPD registation']);
        Permission::create(['name' => 'IPD profile']);

        // Opd TimeLine
        Permission::create(['name' => 'timeline list opd']);
        Permission::create(['name' => 'add timeline list opd']);
        Permission::create(['name' => 'edit timeline list opd']);
        Permission::create(['name' => 'delete timeline list opd']);

        // setup pharmacy
        //
        Permission::create(['name' => 'setup pharmacy']);

        Permission::create(['name' => 'medicine catagory']);
        Permission::create(['name' => 'add medicine catagory']);
        Permission::create(['name' => 'edit medicine catagory']);
        Permission::create(['name' => 'delete medicine catagory']);

        Permission::create(['name' => 'medicine supplier']);
        Permission::create(['name' => 'add medicine supplier']);
        Permission::create(['name' => 'edit medicine supplier']);
        Permission::create(['name' => 'delete medicine supplier']);

        Permission::create(['name' => 'medicine unit']);
        Permission::create(['name' => 'add medicine unit']);
        Permission::create(['name' => 'edit medicine unit']);
        Permission::create(['name' => 'delete medicine unit']);

        Permission::create(['name' => 'medicine dosage']);
        Permission::create(['name' => 'add medicine dosage']);
        Permission::create(['name' => 'edit medicine dosage']);
        Permission::create(['name' => 'delete medicine dosage']);

        Permission::create(['name' => 'dose interval']);
        Permission::create(['name' => 'add dose interval']);
        Permission::create(['name' => 'edit dose interval']);
        Permission::create(['name' => 'delete dose interval']);

        Permission::create(['name' => 'dose duration']);
        Permission::create(['name' => 'add dose duration']);
        Permission::create(['name' => 'edit dose duration']);
        Permission::create(['name' => 'delete dose duration']);

        // main pharmacy
        Permission::create(['name' => 'pharmacy main']);

        // Pharmacy Bill
        Permission::create(['name' => 'pharmacy bill']);
        Permission::create(['name' => 'add pharmacy bill']);
        Permission::create(['name' => 'medicine stock']);

        //medicine
        Permission::create(['name' => 'medicine']);
        Permission::create(['name' => 'add medicine']);
        Permission::create(['name' => 'edit medicine']);
        Permission::create(['name' => 'delete medicine']);

        // medicine purchase
        Permission::create(['name' => 'medicine purchase']);
        Permission::create(['name' => 'add medicine purchase']);
        Permission::create(['name' => 'edit medicine purchase']);
        Permission::create(['name' => 'delete medicine purchase']);

        // medicine import
        Permission::create(['name' => 'medicine import']);
        Permission::create(['name' => 'save medicine import']);


        // bed transfar
        Permission::create(['name' => 'bed transfar history']);
        Permission::create(['name' => 'add bed transfar history']);
        Permission::create(['name' => 'edit bed transfar history']);
        Permission::create(['name' => 'delete bed transfar history']);


        // medication
        Permission::create(['name' => 'medication']);
        Permission::create(['name' => 'save medication']);

        // oxygen monitoring
        Permission::create(['name' => 'save oxygen monitoring']);

        // operation theatre
        Permission::create(['name' => 'save operation theatre']);
        Permission::create(['name' => 'edit operation theatre']);
        Permission::create(['name' => 'delete operation theatre']);
        Permission::create(['name' => 'change status operation theatre']);

        // ipd payment
        Permission::create(['name' => 'save ipd payment']);
        Permission::create(['name' => 'edit ipd payment']);
        Permission::create(['name' => 'delete ipd payment']);

        // ipd charges
        Permission::create(['name' => 'add ipd charges']);
        Permission::create(['name' => 'save ipd charges']);
        Permission::create(['name' => 'edit ipd charges']);
        Permission::create(['name' => 'delete ipd charges']);

        // charges package
        Permission::create(['name' => 'charges package']);

        //package catagory
        Permission::create(['name' => 'package catagory']);
        Permission::create(['name' => 'add package catagory']);
        Permission::create(['name' => 'save package catagory']);
        Permission::create(['name' => 'edit package catagory']);
        Permission::create(['name' => 'delete package catagory']);

        //package sub catagory
        Permission::create(['name' => 'package sub catagory']);
        Permission::create(['name' => 'add package sub catagory']);
        Permission::create(['name' => 'save package sub catagory']);
        Permission::create(['name' => 'edit package sub catagory']);
        Permission::create(['name' => 'delete package sub catagory']);

        //package name
        Permission::create(['name' => 'package name']);
        Permission::create(['name' => 'add package name']);
        Permission::create(['name' => 'save package name']);
        Permission::create(['name' => 'edit package name']);
        Permission::create(['name' => 'delete package name']);

        // opd payment
        Permission::create(['name' => 'opd payment']);
        Permission::create(['name' => 'add opd payment']);
        Permission::create(['name' => 'save opd payment']);
        Permission::create(['name' => 'edit opd payment']);
        Permission::create(['name' => 'delete opd payment']);


        // emg timeline
        Permission::create(['name' => 'emg timeline']);
        Permission::create(['name' => 'add emg timeline']);
        Permission::create(['name' => 'save emg timeline']);
        Permission::create(['name' => 'edit emg timeline']);
        Permission::create(['name' => 'delete emg timeline']);

        // emg payment
        Permission::create(['name' => 'emg payment']);
        Permission::create(['name' => 'add emg payment']);
        Permission::create(['name' => 'save emg payment']);
        Permission::create(['name' => 'edit emg payment']);
        Permission::create(['name' => 'delete emg payment']);

        // medicine store
        Permission::create(['name' => 'medicine store']);
        Permission::create(['name' => 'add medicine store']);
        Permission::create(['name' => 'save medicine store']);
        Permission::create(['name' => 'edit medicine store']);
        Permission::create(['name' => 'delete medicine store']);

        // medicine rack
        Permission::create(['name' => 'medicine rack']);
        Permission::create(['name' => 'add medicine rack']);
        Permission::create(['name' => 'save medicine rack']);
        Permission::create(['name' => 'edit medicine rack']);
        Permission::create(['name' => 'delete medicine rack']);

        // medicine purchase
        Permission::create(['name' => 'medicine purchase']);
        Permission::create(['name' => 'add medicine purchase']);
        Permission::create(['name' => 'save medicine purchase']);
        Permission::create(['name' => 'edit medicine purchase']);
        Permission::create(['name' => 'delete medicine purchase']);

        // medicine requisition
        Permission::create(['name' => 'medicine requisition']);
        Permission::create(['name' => 'add medicine requisition']);
        Permission::create(['name' => 'save medicine requisition']);
        Permission::create(['name' => 'edit medicine requisition']);
        Permission::create(['name' => 'delete medicine requisition']);
        Permission::create(['name' => 'print medicine requisition']);
        Permission::create(['name' => 'view medicine requisition']);

        // medicine vendor
        Permission::create(['name' => 'medicine vendor']);
        Permission::create(['name' => 'add medicine vendor']);
        Permission::create(['name' => 'save medicine vendor']);
        Permission::create(['name' => 'edit medicine vendor']);
        Permission::create(['name' => 'delete medicine vendor']);

        // store room for medicine stock
        Permission::create(['name' => 'medicine storeroom']);
        Permission::create(['name' => 'add medicine storeroom']);
        Permission::create(['name' => 'save medicine storeroom']);
        Permission::create(['name' => 'edit medicine storeroom']);
        Permission::create(['name' => 'delete medicine storeroom']);

        //medicine purchase order
        Permission::create(['name' => 'medicine purchase order']);
        Permission::create(['name' => 'add medicine purchase order']);
        Permission::create(['name' => 'edit medicine purchase order']);
        Permission::create(['name' => 'delete medicine purchase order']);
        Permission::create(['name' => 'save medicine purchase order']);
        Permission::create(['name' => 'Print Medicine Purchase Order']);
        Permission::create(['name' => 'View Medicine Purchase Order']);
        Permission::create(['name' => 'Send PO with feedback form']);
        Permission::create(['name' => 'permission on po section']);
        Permission::create(['name' => 'New Vendor Add in PO section']);
        Permission::create(['name' => 'save feedback']);

        //medicine grn
        Permission::create(['name' => 'Medicine GRN']);
        Permission::create(['name' => 'Medicine GRN Create']);
        Permission::create(['name' => 'GRN Medicine delete']);
        Permission::create(['name' => 'Stock Update After GRN']);

        //Inventroy
        Permission::create(['name' => 'Setup Inventory']);
        //Inventory Catagory
        Permission::create(['name' => 'Inventory Item Catagory']);
        Permission::create(['name' => 'Inventory Item Catagory Create']);
        Permission::create(['name' => 'Inventory Item Catagory View']);
        Permission::create(['name' => 'Inventory Item Catagory Edit']);
        Permission::create(['name' => 'Inventory Item Catagory Update']);
        Permission::create(['name' => 'Inventory Item Catagory Delete']);
        //Inventory Brand
        Permission::create(['name' => 'Inventory Item Brand']);
        Permission::create(['name' => 'Inventory Item Brand Create']);
        Permission::create(['name' => 'Inventory Item Brand Edit']);
        Permission::create(['name' => 'Inventory Item Brand Update']);
        Permission::create(['name' => 'Inventory Item Brand Delete']);
        //Inventory Manufacture
        Permission::create(['name' => 'Inventory Item Manufacture']);
        Permission::create(['name' => 'Inventory Item Manufacture Create']);
        Permission::create(['name' => 'Inventory Item Manufacture Edit']);
        Permission::create(['name' => 'Inventory Item Manufacture Update']);
        Permission::create(['name' => 'Inventory Item Manufacture Delete']);
        //Inventory Item Type
        Permission::create(['name' => 'Inventory Item Type']);
        Permission::create(['name' => 'Inventory Item Type Create']);
        Permission::create(['name' => 'Inventory Item Type Edit']);
        Permission::create(['name' => 'Inventory Item Type Update']);
        Permission::create(['name' => 'Inventory Item Type Delete']);
        //Inventory Item Store Room
        Permission::create(['name' => 'Inventory Store Room']);
        Permission::create(['name' => 'Inventory Store Room Create']);
        Permission::create(['name' => 'Inventory Store Room Edit']);
        Permission::create(['name' => 'Inventory Store Room Update']);
        Permission::create(['name' => 'Inventory Store Room Delete']);
        //Inventory Item
        Permission::create(['name' => 'Inventory Item']);
        Permission::create(['name' => 'Inventory Item Create']);
        Permission::create(['name' => 'Inventory Item Edit']);
        Permission::create(['name' => 'Inventory Item Update']);
        Permission::create(['name' => 'Inventory Item Delete']);
        Permission::create(['name' => 'Inventory Item View']);
        //Inventory Item Attribute
        Permission::create(['name' => 'Inventory Item Attribute']);
        Permission::create(['name' => 'Inventory Item Attribute Create']);
        Permission::create(['name' => 'Inventory Item Attribute Edit']);
        Permission::create(['name' => 'Inventory Item Attribute Update']);
        Permission::create(['name' => 'Inventory Item Attribute Delete']);
        Permission::create(['name' => 'Inventory Item Attribute View']);
        //Inventory Item Uint
        Permission::create(['name' => 'Inventory Item Uint']);
        Permission::create(['name' => 'Inventory Item Uint Create']);
        Permission::create(['name' => 'Inventory Item Uint Edit']);
        Permission::create(['name' => 'Inventory Item Uint Update']);
        Permission::create(['name' => 'Inventory Item Uint Delete']);

        //Main Inventory
        Permission::create(['name' => 'Inventory']);
        Permission::create(['name' => 'Inventory Reqiuisition']);
        Permission::create(['name' => 'Add Inventory Reqiuisition']);
        Permission::create(['name' => 'Save Inventory Reqiuisition']);
        Permission::create(['name' => 'Edit Inventory Reqiuisition']);
        Permission::create(['name' => 'Update Inventory Reqiuisition']);
        Permission::create(['name' => 'Delete Inventory Reqiuisition']);
        Permission::create(['name' => 'Print Inventory Reqiuisition']);
        Permission::create(['name' => 'View Inventory Reqiuisition']);

        //Inventory Setup
        Permission::create(['name' => 'Inventory Vendor']);
        Permission::create(['name' => 'Add Inventory Vendor']);
        Permission::create(['name' => 'Save Inventory Vendor']);
        Permission::create(['name' => 'Edit Inventory Vendor']);
        Permission::create(['name' => 'Update Inventory Vendor']);
        Permission::create(['name' => 'Delete Inventory Vendor']);
        Permission::create(['name' => 'View Inventory Vendor']);

        //Blood Bank
        Permission::create(['name' => 'Blood Donar']);
        Permission::create(['name' => 'Add Blood Donar']);
        Permission::create(['name' => 'Edit Blood Donar']);
        Permission::create(['name' => 'Delete Blood Donar']);
        Permission::create(['name' => 'Update Blood Donar']);
        Permission::create(['name' => 'View Blood Donar']);

        //Front Office setup  // purpose
        Permission::create(['name' => 'purpose']);
        Permission::create(['name' => 'Add purpose']);
        Permission::create(['name' => 'Edit purpose']);
        Permission::create(['name' => 'Update purpose']);
        Permission::create(['name' => 'Delete purpose']);

        //Front Office setup  // complain type
        Permission::create(['name' => 'complain type']);
        Permission::create(['name' => 'Add complain type']);
        Permission::create(['name' => 'Edit complain type']);
        Permission::create(['name' => 'Update complain type']);
        Permission::create(['name' => 'Delete complain type']);

        //Front Office setup  // source
        Permission::create(['name' => 'source']);
        Permission::create(['name' => 'Add source']);
        Permission::create(['name' => 'Edit source']);
        Permission::create(['name' => 'Update source']);
        Permission::create(['name' => 'Delete source']);

        //Front Office setup  // appointment priority
        Permission::create(['name' => 'appointment priority']);
        Permission::create(['name' => 'Add appointment priority']);
        Permission::create(['name' => 'Edit appointment priority']);
        Permission::create(['name' => 'Update appointment priority']);
        Permission::create(['name' => 'Delete appointment priority']);

        //Blood
        Permission::create(['name' => 'blood']);
        Permission::create(['name' => 'Add blood']);
        Permission::create(['name' => 'View blood']);
        Permission::create(['name' => 'View blood details']);

        //Blood Unit Type
        Permission::create(['name' => 'Blood unit type']);
        Permission::create(['name' => 'Add blood unit type']);
        Permission::create(['name' => 'View blood unit type']);
        Permission::create(['name' => 'Edit blood unit type']);
        Permission::create(['name' => 'Delete blood unit type']);

        //Blood Components
        Permission::create(['name' => 'blood components']);
        Permission::create(['name' => 'Add blood components']);
        Permission::create(['name' => 'View blood components Details']);
      

        //opd billing
        Permission::create(['name' => 'opd billing']);
        Permission::create(['name' => 'add opd billing']);
        Permission::create(['name' => 'edit opd billing']);
        Permission::create(['name' => 'delete opd billing']);

        //discount
        Permission::create(['name' => 'discount']);


        //opd physical condition
        Permission::create(['name' => 'opd physical condition']);
        Permission::create(['name' => 'add opd physical condition']);
        Permission::create(['name' => 'edit physical condition']);
        Permission::create(['name' => 'update opd physical condition']);
        Permission::create(['name' => 'delete physical condition']);

        //emg physical condition
        Permission::create(['name' => 'emg physical condition']);
        Permission::create(['name' => 'add emg physical condition']);
        Permission::create(['name' => 'edit emg physical condition']);
        Permission::create(['name' => 'delete emg physical condition']);

        // Emg TimeLine
        Permission::create(['name' => 'timeline list emg']);
        Permission::create(['name' => 'add timeline list emg']);
        Permission::create(['name' => 'edit timeline list emg']);
        Permission::create(['name' => 'delete timeline list emg']);

        // emg payment
        Permission::create(['name' => 'emg payment']);
        Permission::create(['name' => 'add emg payment']);
        Permission::create(['name' => 'save emg payment']);
        Permission::create(['name' => 'edit emg payment']);
        Permission::create(['name' => 'delete emg payment']);

        //ipd timeline
        Permission::create(['name' => 'ipd tismeline']);
        Permission::create(['name' => 'add timeline list ipd']);
        Permission::create(['name' => 'edit timeline ipd']);
        Permission::create(['name' => 'add timeline ipd']);

        //emg billing
        Permission::create(['name' => 'add emg billing']);
        Permission::create(['name' => 'add timeline list ipd']);
        Permission::create(['name' => 'edit timeline ipd']);
        Permission::create(['name' => 'add timeline ipd']);

        //update stock
        Permission::create(['name' => 'update stock from back']);

        //False Generation
        Permission::create(['name' => 'False Generation']);
        Permission::create(['name' => 'OPD False']);

        // bill summary
        Permission::create(['name' => 'bill summary']);
        Permission::create(['name' => 'create bill summary']);

        //medicine 
        Permission::create(['name' => 'Medicine Details']);

        //charges opd
        Permission::create(['name' => 'add opd charges']);
        Permission::create(['name' => 'edit opd charges']);
        Permission::create(['name' => 'patient charges']);

        //pathology test add to patient
        Permission::create(['name' => 'pathology-test-to-a-patient']);
        Permission::create(['name' => 'add-pathology-test-to-a-patient']);
        Permission::create(['name' => 'edit-pathology-test-to-a-patient']);
        Permission::create(['name' => 'delete-pathology-test-to-a-patient']);

        //OPD Pathology Investigation
        Permission::create(['name' => 'OPD Pathology Investigation']);
        Permission::create(['name' => 'OPD Radiology Investigation']);

        Permission::create(['name' => 'Create Prescription for OPD']);


    }
}
