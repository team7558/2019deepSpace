/*----------------------------------------------------------------------------*/
/* Copyright (c) 2018 FIRST. All Rights Reserved.                             */
/* Open Source Software - may be modified and shared by FRC teams. The code   */
/* must be accompanied by the FIRST BSD license file in the root directory of */
/* the project.                                                               */
/*----------------------------------------------------------------------------*/

package frc.robot.subsystems;

import edu.wpi.first.wpilibj.Solenoid;
import edu.wpi.first.wpilibj.command.Subsystem;
<<<<<<< HEAD
import frc.robot.Robot;
=======
import com.ctre.phoenix.motorcontrol.can.VictorSPX;
>>>>>>> 9c6d0775656e1783419290d780b49b623c90288c
import com.ctre.phoenix.motorcontrol.ControlMode;

/**
 * Add your docs here.
 */
public class Cargo extends Subsystem {
  public static VictorSPX m_intake_1, m_intake_2;
  public static Solenoid m_testSolenoid;

  public Cargo() {
    m_intake_1 = new VictorSPX(4);
    m_intake_2 = new VictorSPX(5);
    m_testSolenoid = new Solenoid(3);
  }

  public void shoot() {
    m_intake_1.set(ControlMode.PercentOutput, 1);
    m_intake_2.set(ControlMode.PercentOutput, -1);
    if (m_intake_1.getMotorOutputPercent() >= 0.95 && m_intake_2.getMotorOutputPercent() >= 0.95) {
      m_testSolenoid.set(true);
    }

  }
<<<<<<< HEAD
  
  public void shootCargo(){
   

    System.out.println("Trent");
=======

  public void stopShoot() {
    m_intake_1.set(ControlMode.PercentOutput, 0);
    m_intake_2.set(ControlMode.PercentOutput, 0);
    m_testSolenoid.set(false);
>>>>>>> 9c6d0775656e1783419290d780b49b623c90288c
  }

  @Override
  public void initDefaultCommand() {
    // Set the default command for a subsystem here.
    // setDefaultCommand(new MySpecialCommand());
  }
}
