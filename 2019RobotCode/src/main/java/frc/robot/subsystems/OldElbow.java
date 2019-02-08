/*----------------------------------------------------------------------------*/
/* Copyright (c) 2018 FIRST. All Rights Reserved.                             */
/* Open Source Software - may be modified and shared by FRC teams. The code   */
/* must be accompanied by the FIRST BSD license file in the root directory of */
/* the project.                                                               */
/*----------------------------------------------------------------------------*/

package frc.robot.subsystems;

import edu.wpi.first.wpilibj.command.PIDSubsystem;
import com.revrobotics.CANEncoder;
import com.revrobotics.CANSparkMax;
import com.revrobotics.CANSparkMaxLowLevel.MotorType;
import frc.robot.RobotMap;

/**
 * Add your docs here.
 */
public class OldElbow extends PIDSubsystem {
  public static final double ENCODER_PER_ANGLE = 0.82751878;
  public double zeroEncoder;
  public double targetAngle;
  public CANSparkMax m_elbowController; 
  public CANEncoder m_elbowEncoder;
  public static double maxAngle = 90;
  /**
   * Add your docs here.
   */


  public OldElbow() {
    // Intert a subsystem name and PID values here
    super("Elbow", 0.1, 0, 0);
    // Use these to get going:
    setSetpoint(0);
    
    // to
   // setAbsoluteTolerance(0.05);
    //getPIDController().setContinuous(false);

    m_elbowController = new CANSparkMax(RobotMap.ELBOW_MOTOR, MotorType.kBrushless);
    m_elbowEncoder = new CANEncoder(m_elbowController);

  }

  @Override
  public void initDefaultCommand() {
    // Set the default command for a subsystem here.
    //setDefaultCommand(new DriveElbow());
  }

  @Override
  protected double returnPIDInput() {
    return getAngle();
  }

  @Override
  protected void usePIDOutput(double output) {
    // Use output to drive your system, like a motor
    // e.g. yourMotor.set(output);
   // elbowController.set(output);
    //System.out.println("Current : " + elbowEncoder.getPosition());
    //System.out.println(output);
    if (getAngle() >=0 && getAngle() <= 90){
      //elbowController.set(-output);
      System.out.println("Target: " + targetAngle + " Current Angle: " + getAngle() + " PID Output: " + output);

    }
  }

  public void setAngle(double targetAngle){
    //if (targetAngle < maxAngle && targetAngle >= 0);
    this.targetAngle = targetAngle; 
    setSetpoint(this.targetAngle);
  }

  public void resetAngle(){
    zeroEncoder = m_elbowEncoder.getPosition();
  }

  public double getAngle(){
    return -(m_elbowEncoder.getPosition()-zeroEncoder)/ENCODER_PER_ANGLE;
  }

//  public void stop(){
//    elbowController.set(0);
//  }

//  public double getDistance(){
//    return elbowEncoder.getPosition();
//  }
}
